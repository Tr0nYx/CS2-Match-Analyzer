var fs = require("fs"),
    demofile = require("demofile"),
    path = require("path"),
    assert = require('assert'),
    util = require('util'),
    player_1 = require("demofile/dist/entities/player"),
    parser = require('@laihoe/demoparser2')

let demoPath;
let filePath;
let json = {};
let teams = {
    0: 'none',
    1: 'spectator',
    2: 'TERRORIST',
    3: 'CT'
};

let reasons = {
    1: 'target_bombed', // t win
    7: 'bomb_defused', // ct win
    8: 'terrorists_killed', // ct win
    9: 'cts_killed', // t win
    12: 'target_saved', // ct win
    17: 'terrorists_surrender', // ct win
    18: 'ct_surrender' // t win
};

function parseRound() {
    let ticks = {};
    let player_deaths = {};
    let allEvents = parser.parseEvents(demoPath, ["round_end", "player_hurt", "player_death", "bomb_planted", "bomb_defused","other_death", "weapon_fire"], ["last_place_name","total_rounds_played", "is_warmup_period", "team_name", "team_num"], ["total_rounds_played", "is_warmup_period"]);
    let events = allEvents.filter(e => e.weapon !== "world");
    let match = {};
    let players = json.players;
    for (let i = 0; i < events.length; i++) {
        let event = events[i];
        let tick = Math.ceil(event.tick);
        if (event.is_warmup_period === true) {
            continue;
        }
        ticks[tick] = {};

        if (typeof (match[event.total_rounds_played]) == "undefined") {
            match[event.total_rounds_played] = {};
            match[event.total_rounds_played]["EnemyKills"] = 0;
        }

        if (event.event_name === "player_death") {
            ticks[tick]['player_deaths'] = [];
            player_deaths = [];
            player_deaths.push({
                'round': event.total_rounds_played,
                'attacker': event.attacker_steamid,
                'victim': event.user_steamid,
                'headshot': event.headshot,
                'noscope': event.noscope,
                'penetrated': event.penetrated,
                'blind': event.attackerblind,
                'thrusmoke': event.thrusmoke,
                'dmg_armor': event.dmg_armor,
                'dmg_health': event.dmg_health,
                'weapon': event.weapon,
            });

            if (event.assister_steamid != null) {
                players[event.assister_steamid]["assists"] += 1;
                let damage = event.dmg_armor + event.dmg_health;
                players[event.assister_steamid]["damage"] += damage;
            }
            if (event.attacker_steamid != null) {
                let damage = event.dmg_armor + event.dmg_health;
                
                //players[event.attacker_steamid]["kills"] += 1;
                players[event.attacker_steamid]["damage"] += damage;
                if (event.headshot === true) {
                    players[event.attacker_steamid]["headshots"] += 1;
                    if (typeof(players[event.attacker_steamid]["weapon_stats"]["headshots"][event.weapon]) == "undefined"){
                        players[event.attacker_steamid]["weapon_stats"]["headshots"][event.weapon] = 0;
                    }
                    players[event.attacker_steamid]["weapon_stats"]["headshots"][event.weapon] += 1;
                }
                if (event.noscope === true) {
                    players[event.attacker_steamid]["NoScope"] += 1;
                }
                if (event.attackerblind === true) {
                    players[event.attacker_steamid]["KillBlinded"] += 1;
                }
                if (event.penetrated === true) {
                    players[event.attacker_steamid]["KillWallbang"] += 1;
                }
                if (event.thrusmoke === true) {
                    players[event.attacker_steamid]["KillThruSmoke"] += 1;
                }
                
                if (typeof(players[event.attacker_steamid]["weapon_stats"]["kills"][event.weapon]) == "undefined"){
                    players[event.attacker_steamid]["weapon_stats"]["kills"][event.weapon] = 0; 
                }
                players[event.attacker_steamid]["weapon_stats"]["kills"][event.weapon] += 1;
                if (match[event.total_rounds_played]["EnemyKills"] === 0) {
                    players[event.attacker_steamid]["firstkills"]++;
                }
            }
            if (event.user_steamid != null) {
                //players[event.user_steamid]["deaths"] += 1;
                if (match[event.total_rounds_played]["EnemyKills"] === 0) {
                    players[event.user_steamid]["firstdeaths"]++
                }
            }
            match[event.total_rounds_played]["EnemyKills"] += 1;
            ticks[tick]['player_deaths'].push(player_deaths);
        }
        if (event.event_name == "weapon_fire"){
            if (event.user_steamid != null) {
                let weapon = event.weapon.split("weapon_").pop();
                if (typeof(players[event.user_steamid]["weapon_stats"]["shots"][weapon]) == "undefined"){
                   players[event.user_steamid]["weapon_stats"]["shots"][weapon] = 0; 
                }
                players[event.user_steamid]["weapon_stats"]["shots"][weapon] += 1;
            }
        }
        
        if (event.event_name === "player_hurt") {
            if (event.attacker_steamid != null) {
                if (event.weapon == "hegrenade"){
                    HeDamage = event.dmg_armor + event.dmg_health;
                    players[event.attacker_steamid]["HeDamage"] += HeDamage;
                }
                if (event.weapon == "molotov" || event.weapon == "inferno"){
                    BurnDamage = event.dmg_armor + event.dmg_health;
                    players[event.attacker_steamid]["BurnDamage"] += BurnDamage;
                }
                let weapon_damage = event.dmg_armor + event.dmg_health;
                if (typeof(players[event.attacker_steamid]["weapon_stats"]["damage"][event.weapon]) == "undefined"){
                   players[event.attacker_steamid]["weapon_stats"]["damage"][event.weapon] = 0; 
                }
                players[event.attacker_steamid]["weapon_stats"]["damage"][event.weapon] += weapon_damage;
                if (typeof(players[event.attacker_steamid]["weapon_stats"]["hits"][event.weapon]) == "undefined"){
                   players[event.attacker_steamid]["weapon_stats"]["hits"][event.weapon] = 0; 
                }
                players[event.attacker_steamid]["weapon_stats"]["hits"][event.weapon] += 1;
                players[event.attacker_steamid]["weapon_stats"]["accuracy"][event.weapon] = 0;
            }
        }
        if (event.event_name === "bomb_planted") {
            ticks[tick]['bomb_plant'] = [];
            bomb_plant = [];
            bomb_plant.push({
                'user': event.user_steamid,
            });
            ticks[tick]['bomb_plant'].push(bomb_plant);
        }
        if (event.event_name === "bomb_defused") {
            //console.log(event);
            ticks[tick]['bomb_defuse'] = [];
            bomb_defuse = [];
            bomb_defuse.push({
                'user': event.user_steamid,
            });
            ticks[tick]['bomb_defuse'].push(bomb_defuse);
        }
        if (event.other_type === "chicken") {
            console.log(event);
        }
        if (event.event_name === "round_end") {
            for (var player in players) {
                players[player]["hspercent"] = (players[player]["headshots"] / players[player]["kills"]) * 100 || 0;
                players[player]["kd"] = (players[player]["kills"] / players[player]["deaths"]) || 0;
                players[player]["adr"] = players[player]["damage"] / event.total_rounds_played;
                
                for (var weapon in players[player]["weapon_stats"]["accuracy"]){
                    let accuracy = players[player]["weapon_stats"]["hits"][weapon] / players[player]["weapon_stats"]["shots"][weapon] || 0
                    players[player]["weapon_stats"]["accuracy"][weapon] = accuracy;
                }
                if (players[player].kills > 0 || players[player].assists > 0 || players[player].deaths == 0){
                    players[player]["kastRounds"] = players[player]["kastRounds"] + 1 || 0;
                }
            }
        }
    }

    let kills = events.filter(e => e.event_name === "player_death")
    let killsNoWarmup = kills.filter(kill => kill.is_warmup_period === false)
    let filteredKills = killsNoWarmup.filter(kill => kill.attacker_team_name !== kill.user_team_name)
    let maxRound = Math.max(...kills.map(o => o.total_rounds_played))

    for (let round = 0; round <= maxRound; round++) {
        const killsPerPlayer = {};
        let killsThisRound = filteredKills.filter(kill => kill.total_rounds_played === round)
        killsThisRound.forEach(item => {
            
            const lastKill = killsThisRound[killsThisRound.length - 1];
            if (item.attacker_steamid == lastKill.user_steamid && (lastKill.tick - item.tick) < (5 * 64)){
                players[item.attacker_steamid]["tradekills"]++;
                if (item.user_steamid != null) {
                    players[item.user_steamid]["tradedeaths"]++;
                }
            }
            if (item.total_rounds_played > lastKill.total_rounds_played){
                players[item.attacker_steamid]["tradefirstkills"]++;
                players[item.user_steamid]["tradefirstdeaths"]++;
            }
            const attacker_steamid = item.attacker_steamid;
            const kills = killsPerPlayer[attacker_steamid] || 0;
            killsPerPlayer[attacker_steamid] = kills + 1;
            
        });

        for (let player in killsPerPlayer) {
            if (player != "null"){
                if (killsPerPlayer[player] === 5) {
                    players[player]["rounds5k"]++
                }
                if (killsPerPlayer[player] === 4) {
                    players[player]["rounds4k"]++
                }
                if (killsPerPlayer[player] === 3) {
                    players[player]["rounds3k"]++
                }
                if (killsPerPlayer[player] === 2) {
                    players[player]["rounds2k"]++
                }
                if (killsPerPlayer[player] === 1) {
                    players[player]["rounds1k"]++
                }
            }
        }
    }
    
    let deaths = parser.parseEvent(demoPath, "player_death", [], ["total_rounds_played"])
    let wantedTicks = deaths.map(x => x.tick)
    let round_ends = parser.parseEvent(demoPath, "round_end")
    let tickData = parser.parseTicks(demoPath, ["is_alive", "team_name", "team_rounds_total"], wantedTicks)
    maxRound = Math.max(...deaths.map(x => x.total_rounds_played))

    for (let i = 0; i <= maxRound; i++){
        let res1vx = find_if_1vx(deaths, i, round_ends, tickData, 1);
        if (res1vx != undefined){
            players[res1vx]["roundswonv1"]++
        }
        let res2vx = find_if_1vx(deaths, i, round_ends, tickData, 2);
        if (res2vx != undefined){
            players[res2vx]["roundswonv2"]++
        }
        let res3vx = find_if_1vx(deaths, i, round_ends, tickData, 3);
        if (res3vx != undefined){
            players[res3vx]["roundswonv3"]++
        }
        let res4vx = find_if_1vx(deaths, i, round_ends, tickData, 4);
        if (res4vx != undefined){
            players[res4vx]["roundswonv4"]++
        }
        let res5vx = find_if_1vx(deaths, i, round_ends, tickData, 5);
        if (res5vx != undefined){
            players[res5vx]["roundswonv5"]++
        }
        
        let res1vxlost = find_if_1vx_lost(deaths, i, round_ends, tickData, 1);
        if (res1vxlost != undefined){
            players[res1vxlost]["roundslostv1"]++
        }
        let res2vxlost = find_if_1vx_lost(deaths, i, round_ends, tickData, 2);
        if (res2vxlost != undefined){
            players[res2vxlost]["roundslostv2"]++
        }
        let res3vxlost = find_if_1vx_lost(deaths, i, round_ends, tickData, 3);
        if (res3vxlost != undefined){
            players[res3vxlost]["roundslostv3"]++
        }
        let res4vxlost = find_if_1vx_lost(deaths, i, round_ends, tickData, 4);
        if (res4vxlost != undefined){
            players[res4vxlost]["roundslostv4"]++
        }
        let res5vxlost = find_if_1vx_lost(deaths, i, round_ends, tickData, 5);
        if (res5vxlost != undefined){
            players[res5vxlost]["roundslostv5"]++
        }
    }

    //console.log(players);

    json.players = players;
    json.ticks = ticks;
}

function find_if_1vx(deaths, round_idx, round_ends, tickData, X){
    for (let i = 0; i < deaths.length; i++){
        if (deaths[i].total_rounds_played == round_idx){
            
            if (typeof(round_ends[round_idx]) == "undefined"){
                return;
            }
            let tickData_slice = tickData.filter(t => t.tick == deaths[i].tick)
            let ctAlive = tickData_slice.filter(t => t.team_name == "CT" && t.is_alive == true)
            let tAlive = tickData_slice.filter(t => t.team_name == "TERRORIST" && t.is_alive == true)
            // 3 = CT
            
            if (ctAlive.length == 1 && tAlive.length == X && round_ends[round_idx].winner == 3){
                return ctAlive[0].steamid
            }
            // 2 = T
            if (tAlive.length == 1 && ctAlive.length == X && round_ends[round_idx].winner == 2){
                return tAlive[0].steamid
            }
        }
    }
}

function find_if_1vx_lost(deaths, round_idx, round_ends, tickData, X){
    for (let i = 0; i < deaths.length; i++){
        if (deaths[i].total_rounds_played == round_idx){
            
            if (typeof(round_ends[round_idx]) == "undefined"){
                return;
            }
            let tickData_slice = tickData.filter(t => t.tick == deaths[i].tick)
            let ctAlive = tickData_slice.filter(t => t.team_name == "CT" && t.is_alive == true)
            let tAlive = tickData_slice.filter(t => t.team_name == "TERRORIST" && t.is_alive == true)
            // 3 = CT
            
            if (ctAlive.length == 1 && tAlive.length == X && round_ends[round_idx].winner == 2){
                return ctAlive[0].steamid
            }
            // 2 = T
            if (tAlive.length == 1 && ctAlive.length == X && round_ends[round_idx].winner == 3){
                return tAlive[0].steamid
            }
        }
    }
}

function init() {
    let players = {};

    //let events = parser.listGameEvents(demoPath);
    //console.log(events);
    let wins = parser.parseEvent(demoPath, "rank_update", ["clan_name", "team_name"]);
    for (const update of wins) {
        players[update.user_steamid] = {}
        players[update.user_steamid]["weapon_stats"] = {}
        players[update.user_steamid]["weapon_stats"]["damage"] = {}
        players[update.user_steamid]["weapon_stats"]["kills"] = {}
        players[update.user_steamid]["weapon_stats"]["headshots"] = {}
        players[update.user_steamid]["weapon_stats"]["hits"] = {}
        players[update.user_steamid]["weapon_stats"]["accuracy"] = {}
        players[update.user_steamid]["weapon_stats"]["shots"] = {}
        players[update.user_steamid]['steamid64'] = update.user_steamid;
        players[update.user_steamid]['userName'] = update.user_name;
        players[update.user_steamid]['clantag'] = update.user_clan_name;
        players[update.user_steamid]['numWins'] = update.num_wins;
        players[update.user_steamid]['rankChange'] = update.rank_change;
        if (update.rank_old !== 0){
            players[update.user_steamid]['rankold'] = update.rank_old;
        } else if (update.rank_old == 0){
            let oldRank = update.rank_new + (update.rank_change * -1);
            players[update.user_steamid]['rankold'] = oldRank;
        }
        players[update.user_steamid]['rank'] = update.rank_new;
        var values = Object.values(teams);
        players[update.user_steamid]['team'] = values.indexOf(update.user_team_name);
        //players[update.user_steamid]['team'] = teams[0];
        players[update.user_steamid]['firstdeaths'] = 0;
        players[update.user_steamid]['firstkills'] = 0;
        players[update.user_steamid]['kills'] = 0;
        players[update.user_steamid]['deaths'] = 0;
        players[update.user_steamid]['mvps'] = 0;
        players[update.user_steamid]['damage'] = 0;
        players[update.user_steamid]['headshots'] = 0;
        players[update.user_steamid]['hspercent'] = 0;
        players[update.user_steamid]['assists'] = 0;
        players[update.user_steamid]['kd'] = 0;
        players[update.user_steamid]['adr'] = 0;
        players[update.user_steamid]['rounds5k'] = 0;
        players[update.user_steamid]['rounds4k'] = 0;
        players[update.user_steamid]['rounds3k'] = 0;
        players[update.user_steamid]['rounds2k'] = 0;
        players[update.user_steamid]['rounds1k'] = 0;
        players[update.user_steamid]['tradekills'] = 0;
        players[update.user_steamid]['tradedeaths'] = 0;
        players[update.user_steamid]['tradefirstkills'] = 0;
        players[update.user_steamid]['tradefirstdeaths'] = 0;
        players[update.user_steamid]['NoScope'] = 0;
        players[update.user_steamid]['KillBlinded'] = 0;
        players[update.user_steamid]['KillWallbang'] = 0;
        players[update.user_steamid]['KillThruSmoke'] = 0;
        players[update.user_steamid]['HeDamage'] = 0;
        players[update.user_steamid]['BurnDamage'] = 0;
        players[update.user_steamid]['roundswonv5'] = 0;
        players[update.user_steamid]['roundswonv4'] = 0;
        players[update.user_steamid]['roundswonv3'] = 0;
        players[update.user_steamid]['roundswonv2'] = 0;
        players[update.user_steamid]['roundswonv1'] = 0;
        players[update.user_steamid]['roundslostv5'] = 0;
        players[update.user_steamid]['roundslostv4'] = 0;
        players[update.user_steamid]['roundslostv3'] = 0;
        players[update.user_steamid]['roundslostv2'] = 0;
        players[update.user_steamid]['roundslostv1'] = 0;
        players[update.user_steamid]['kastRounds'] = 0;
    }
    json.players = players;
}


function parseMatch() {
    let header = parser.parseHeader(demoPath);
    json.general = {};
    json.general.map_name = header.map_name;
    json.general.server_name = header.server_name;
    let round = {};
    let score_team_one = 0;
    let score_team_two = 0;
    let events = parser.parseEvents(demoPath, ["round_end"], ["total_rounds_played"], ["round_win_reason", "game_time", "round_start_time"])
    //let nonWorld = events.filter(e => e.weapon !== "world");
    
    for (let i = 0; i < events.length; i++) {

        let deathTime = events[i].game_time;
        let roundStartTime = events[i].round_start_time;
        round[i] = {};
        if (events[i].winner == 2)
        {
            if (i >= 12 && i <= 26){
                score_team_two++;
            } else {
                score_team_one++;
            }
        }
        if (events[i].winner == 3)
        {
            if (i >= 12 && i <= 26){
                score_team_one++;
            } else {
                score_team_two++;
            }
        }
        round[i]['reason'] = reasons[events[i].reason];
        round[i]['phase'] = events[i].is_warmup_period;
        round[i]['length'] = deathTime - roundStartTime
        json.general.match_duration = events[i].game_time;
        json.general.totalRounds = i + 1;
    }
    json.general.score_team_one = score_team_one;
    json.general.score_team_two = score_team_two;
    json.general.round = round;
    
}

function parseScoreboard() {
    let players = json.players;
    let gameEndTick = Math.max(...parser.parseEvent(demoPath,"round_end").map(x => x.tick))

    let fields = ["kills_total", "deaths_total", "mvps", "headshot_kills_total", "ace_rounds_total", "score" ,"team_num"]
    let scoreboard = parser.parseTicks(demoPath, fields, [gameEndTick])
    for (const player of scoreboard) {
        players[player.steamid]['kills'] = player.kills_total;
        players[player.steamid]['deaths'] = player.deaths_total;
        players[player.steamid]['mvps'] = player.mvps;
    }
    json.players = players;
}

function parseAll() {
    demoPath = path.resolve(__dirname, '../matches/') + '/' + process.argv[2] + '.dem';
    filePath = path.resolve(__dirname, '../matches/') + '/' + process.argv[2] + '/';
    if (!fs.existsSync(filePath)) {
        fs.mkdirSync(filePath);
    }
    parseMatch();
    init();
    parseScoreboard();
    parseRound();

    let fileName = filePath + 'stats.json';
    fs.writeFile(fileName, JSON.stringify(json, null, 2), (err) => {
        if (err) throw err;
        console.log(fileName + ' has been saved.');
    });
}
parseAll();