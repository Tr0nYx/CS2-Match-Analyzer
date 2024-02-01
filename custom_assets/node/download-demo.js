var Steam = require("steam"),
    util = require("util"),
    fs = require("fs"),
    csgo = require("csgo"),
    request = require("request"),
    path = require('path'),
    bz2 = require('unbzip2-stream'),
    tarfs = require('tar-fs'),
    bot = new Steam.SteamClient(),
    steamUser = new Steam.SteamUser(bot),
    steamFriends = new Steam.SteamFriends(bot),
    steamGC = new Steam.SteamGameCoordinator(bot, 730),
    CSGOCli = new csgo.CSGOClient(steamUser, steamGC, true),
    readlineSync = require("readline-sync"),
    crypto = require("crypto");

var scriptpath = path.resolve(__dirname);
Steam.servers = require(scriptpath + '/servers.json');

var myArgs = process.argv.slice(2);

const decode = new csgo.SharecodeDecoder(myArgs[0]).decode();

const targetid = myArgs[1];

function MakeSha(bytes) {
    var hash = crypto.createHash('sha1');
    hash.update(bytes);
    return hash.digest();
}

var onSteamLogOn = function onSteamLogOn(response) {
        if (response.eresult == Steam.EResult.OK) {
            util.log('Logged in!');
        } else {
            util.log('error, ', response);
            process.exit();
        }
        steamFriends.setPersonaState(Steam.EPersonaState.Busy);
        util.log("Logged on.");

        util.log("Current SteamID64: " + bot.steamID);
        util.log("Account ID: " + CSGOCli.ToAccountID(bot.steamID));

        CSGOCli.launch();

        CSGOCli.on("unhandled", function (message) {
            util.log("Unhandled msg");
            util.log(message);
        });

        CSGOCli.on("ready", function () {
            util.log("node-csgo ready.");
            CSGOCli.requestGame(decode.matchId, decode.outcomeId, parseInt(decode.tokenId));

            CSGOCli.on("matchList", function (data) {
                var match = data.matches[0],
                    rounds = match.roundstatsall,
                    round = rounds[rounds.length - 1],
                    filepath = path.resolve(__dirname, '../matches/'),
                    timestamp = match.matchtime,
                    filename = targetid + '.dem';
                console.log("Game played at: " + timestamp);

                var filewithpath = filepath + '/' + filename;
                const file = fs.createWriteStream(filewithpath);

                var headers = {
                    "accept-charset": "ISO-8859-1,utf-8;q=0.7,*;q=0.3",
                    "accept-language": "en-US,en;q=0.8",
                    "accept": "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
                    "user-agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.13+ (KHTML, like Gecko) Version/5.1.7 Safari/534.57.2",
                    "accept-encoding": "gzip,deflate",
                };

                const options = {
                    url: round.map,
                    headers: headers
                };

                var compressedRequest = function (options, outStream) {
                    var req = request(options);

                    req.on('response', function (res) {
                        if (res.statusCode !== 200) throw new Error('Status not 200');
                        var stream = res.pipe(bz2()).pipe(outStream);
                        stream.on('finish', function () {
                            util.log("match " + decode.matchId + " saved.");
                            CSGOCli.exit();
                            process.exit();
                        });

                    });

                    req.on('error', function (err) {
                        throw err;
                    })
                };
                compressedRequest(options, file);
            });
        });

        CSGOCli.on("unready", function onUnready() {
            util.log("node-csgo unready.");
        });

        CSGOCli.on("unhandled", function (kMsg) {
            util.log("UNHANDLED MESSAGE " + kMsg);
        });
    },
    onSteamSentry = function onSteamSentry(sentry) {
        util.log("Received sentry.");
        require('fs').writeFileSync(scriptpath + '/sentry', sentry);
    },
    onSteamServers = function onSteamServers(servers) {
        util.log("Received servers.");
        fs.writeFileSync(scriptpath + '/servers.json', JSON.stringify(servers, null, 2));
    };

var username = '';
var password = '';
var authCode = '';

var logOnDetails = {
    "account_name": username,
    "password": password,
};
if (authCode !== "") {
    logOnDetails.auth_code = authCode;
}
var sentry = fs.readFileSync(scriptpath + '/sentry');
if (sentry.length) {
    logOnDetails.sha_sentryfile = MakeSha(sentry);
}
bot.connect();
steamUser.on('updateMachineAuth', function (response, callback) {
    fs.writeFileSync(scriptpath + '/sentry', response.bytes);
    callback({sha_file: MakeSha(response.bytes)});
});
bot.on("logOnResponse", onSteamLogOn)
    .on('sentry', onSteamSentry)
    .on('servers', onSteamServers)
    .on('connected', function () {
        steamUser.logOn(logOnDetails);
    });