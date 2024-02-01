<?php declare(strict_types=1);

namespace App\Services;

use GMP;

/**
 * Class SharecodeDecoder
 * @package App\Services
 */
class SharecodeDecoder
{
    /**
     * @var string
     */
    protected string $shareCodePattern = '';

    /**
     * @var string
     */
    protected string $dictionary = '';

    /**
     * @var int
     */
    protected int $dictionaryLength = 0;

    /**
     * @var string
     */
    protected string $cleanedShareCode = '';

    /**
     * @var array
     */
    protected array $reversedShareCodeArray = [];

    /**
     * @param string $shareCode
     * @return array
     */
    public function decode(string $shareCode): array
    {
        $this->fillVariables($shareCode);
        $bigNumber = $this->getDecodedBigNumber();
        $hexConverted = $this->convertToHex($bigNumber);
        $bytes = $this->convertHexToBytesArray($hexConverted);
        $matchIdBytes = array_reverse(array_slice($bytes, 0, 8));
        $outcomeIdBytes = array_reverse(array_slice($bytes, 8, 8));
        $tokenBytes = array_reverse(array_slice($bytes, 16, 2));

        return [
            'matchId' => $this->getResultFromBytes($matchIdBytes),
            'outcomeId' => $this->getResultFromBytes($outcomeIdBytes),
            'tokenId' => (int)$this->getResultFromBytes($tokenBytes),
        ];
    }

    /**
     * @return string
     */
    public function getDecodedBigNumber(): string
    {
        /** @var GMP $bigNumber */
        $bigNumber = 0;
        foreach ($this->reversedShareCodeArray as $iValue) {
            $bigNumber = gmp_add(
                gmp_mul(
                    $bigNumber,
                    $this->dictionaryLength
                ),
                strpos(
                    $this->dictionary,
                    $iValue
                )
            );
        }

        return gmp_strval($bigNumber);
    }

    /**
     * @param string $number
     * @return string
     */
    public function convertToHex(string $number): string
    {
        $toHex = gmp_strval(gmp_init($number, 10), 16);;

        return $this->padStart($toHex, 36, '0');

    }

    /**
     * @param string $string
     * @param int $length
     * @param string $chars
     * @return string
     */
    public function padStart(string $string, int $length, string $chars = ' '): string
    {
        return str_pad($string, $length, $chars, STR_PAD_LEFT);
    }

    /**
     * @param string $hexString
     * @return array
     */
    public function convertHexToBytesArray(string $hexString): array
    {
        $bytes = [];
        $byteArray = str_split($hexString, 2);
        foreach ($byteArray as $byte) {
            $bytes[] = (int)base_convert($byte, 16, 10);
        }

        return $bytes;
    }

    /**
     * @param array $bytes
     * @return string
     */
    public function getResultFromBytes(array $bytes): string
    {
        $chars = array_map("chr", $bytes);
        $bin = implode($chars);
        $hex = bin2hex($bin);

        return gmp_strval($this->gmp_hexDec($hex));
    }

    /**
     * @param $n
     * @return string
     */
    public function gmp_hexDec($n): string
    {
        $gmp = gmp_init(0);
        $multi = gmp_init(1);
        for ($i = strlen($n) - 1; $i >= 0; $i--, $multi = gmp_mul($multi, 16)) {
            $gmp = gmp_add($gmp, gmp_mul($multi, hexdec($n[$i])));
        }

        return gmp_strval($gmp);
    }

    /**
     * @param string $shareCode
     */
    public function fillVariables(string $shareCode): void
    {
        $this->shareCodePattern = "/CSGO(-?[\w]{5}){5}$/";
        $this->dictionary = "ABCDEFGHJKLMNOPQRSTUVWXYZabcdefhijkmnopqrstuvwxyz23456789";
        $this->dictionaryLength = strlen($this->dictionary);
        $this->cleanedShareCode = str_replace(array("CSGO", "-"), "", $shareCode);
        $this->reversedShareCodeArray = array_reverse(str_split($this->cleanedShareCode));
    }
}