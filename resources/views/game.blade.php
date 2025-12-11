<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS Strike - Counter Strike Inspired Game</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a2e 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #fff;
            overflow: hidden;
        }

        .game-container {
            position: relative;
            width: 100%;
            max-width: 1200px;
            height: 100vh;
            background: #0a0a0a;
            display: flex;
            flex-direction: column;
        }

        #gameCanvas {
            display: block;
            width: 100%;
            flex: 1;
            background: linear-gradient(180deg, #1a1a2e 0%, #0f3460 50%, #16213e 100%);
            cursor: crosshair;
        }

        .ui-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 20px;
            background: rgba(0, 0, 0, 0.8);
            border-top: 2px solid #ff4500;
            font-size: 14px;
        }

        .ui-section {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .ui-stat {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .ui-label {
            font-size: 11px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .ui-value {
            font-size: 16px;
            font-weight: bold;
            color: #ffaa00;
            font-family: 'Courier New', monospace;
        }

        .ui-health {
            color: #00ff00;
        }

        .ui-ammo {
            color: #ffaa00;
        }

        .ui-money {
            color: #00ff00;
        }

        .round-indicator {
            text-align: center;
        }

        .round-indicator .ui-value {
            font-size: 18px;
            color: #ff4500;
        }

        .status-message {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            z-index: 1000;
            pointer-events: none;
        }

        .status-message h2 {
            font-size: 48px;
            color: #ff4500;
            text-shadow: 0 0 20px rgba(255, 69, 0, 0.8);
            margin: 10px 0;
            animation: pulse 0.5s ease-in-out;
        }

        .status-message p {
            font-size: 20px;
            color: #fff;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
        }

        @keyframes pulse {
            0% { transform: scale(0.5); opacity: 0; }
            50% { opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }

        .weapon-display {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .weapon-icon {
            width: 30px;
            height: 30px;
            background: linear-gradient(135deg, #ffaa00, #ff6600);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #ff4500;
            border-radius: 3px;
            font-size: 12px;
            font-weight: bold;
        }

        .crosshair {
            position: absolute;
            pointer-events: none;
            z-index: 999;
        }

        .chat-container {
            position: absolute;
            bottom: 20px;
            left: 20px;
            max-width: 300px;
            z-index: 500;
        }

        .chat-message {
            background: rgba(0, 0, 0, 0.7);
            padding: 5px 10px;
            margin: 2px 0;
            font-size: 12px;
            border-left: 2px solid #ff4500;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .instructions {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(0, 0, 0, 0.7);
            padding: 15px;
            border: 1px solid #ff4500;
            font-size: 12px;
            max-width: 250px;
            z-index: 500;
        }

        .instructions h3 {
            color: #ff4500;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .instructions p {
            margin: 3px 0;
            color: #ccc;
        }

        .hud-hit-indicator {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 100;
        }

        .damage-indicator {
            position: absolute;
            font-size: 20px;
            color: #ff4444;
            font-weight: bold;
            text-shadow: 0 0 5px #ff0000;
            pointer-events: none;
            animation: damageFloat 1s ease-out forwards;
        }

        @keyframes damageFloat {
            0% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
            100% {
                opacity: 0;
                transform: translateY(-30px) scale(1.2);
            }
        }

        .game-over-screen {
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }

        .game-over-screen.active {
            display: flex;
        }

        .game-over-content {
            text-align: center;
        }

        .game-over-content h1 {
            font-size: 48px;
            color: #ff4500;
            margin-bottom: 20px;
            text-shadow: 0 0 20px rgba(255, 69, 0, 0.8);
        }

        .game-stats {
            background: rgba(255, 69, 0, 0.1);
            border: 2px solid #ff4500;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }

        .game-stats p {
            font-size: 16px;
            margin: 8px 0;
            color: #fff;
        }

        .restart-button {
            background: linear-gradient(135deg, #ff4500, #ff6600);
            border: none;
            color: white;
            padding: 12px 30px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 3px;
            margin-top: 20px;
            transition: all 0.3s ease;
        }

        .restart-button:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(255, 69, 0, 0.8);
        }

        .team-indicator {
            padding: 8px 12px;
            border-radius: 3px;
            font-weight: bold;
            font-size: 12px;
        }

        .team-t {
            background: rgba(255, 165, 0, 0.3);
            border: 1px solid #ffa500;
            color: #ffa500;
        }

        .team-ct {
            background: rgba(100, 200, 255, 0.3);
            border: 1px solid #64c8ff;
            color: #64c8ff;
        }
    </style>
</head>
<body>
    <div class="game-container">
        <div class="ui-container">
            <div class="ui-section">
                <div class="ui-stat">
                    <span class="ui-label">Health</span>
                    <span class="ui-value ui-health" id="health">100</span>
                </div>
                <div class="ui-stat">
                    <span class="ui-label">Ammo</span>
                    <span class="ui-value ui-ammo" id="ammo">30/120</span>
                </div>
                <div class="ui-stat weapon-display">
                    <span class="ui-label">Weapon</span>
                    <span class="weapon-icon" id="weapon">M4</span>
                </div>
            </div>

            <div class="ui-section round-indicator">
                <div class="ui-stat">
                    <span class="ui-label">Round</span>
                    <span class="ui-value" id="round">1</span>
                </div>
                <div class="ui-stat">
                    <span class="ui-label" id="teamLabel">Team</span>
                    <span class="ui-value team-indicator" id="team">T</span>
                </div>
            </div>

            <div class="ui-section">
                <div class="ui-stat">
                    <span class="ui-label">Kills</span>
                    <span class="ui-value" id="kills">0</span>
                </div>
                <div class="ui-stat">
                    <span class="ui-label">Deaths</span>
                    <span class="ui-value" id="deaths">0</span>
                </div>
                <div class="ui-stat">
                    <span class="ui-label">Money</span>
                    <span class="ui-value ui-money" id="money">$0</span>
                </div>
            </div>
        </div>

        <canvas id="gameCanvas"></canvas>

        <div id="statusMessage" class="status-message" style="display: none;">
            <h2 id="statusTitle"></h2>
            <p id="statusText"></p>
        </div>

        <div id="hitIndicator" class="hud-hit-indicator"></div>

        <div class="chat-container" id="chatContainer"></div>

        <div class="instructions">
            <h3>CS STRIKE</h3>
            <p><strong>Controls:</strong></p>
            <p>🖱️ Move: Mouse</p>
            <p>🖱️ Shoot: Left Click</p>
            <p>R: Reload</p>
            <p>WASD: Move</p>
            <p>Space: Jump</p>
            <p><strong>Objective:</strong></p>
            <p>Eliminate all enemies!</p>
        </div>

        <div id="gameOverScreen" class="game-over-screen">
            <div class="game-over-content">
                <h1 id="gameOverTitle">Round Over</h1>
                <div class="game-stats">
                    <p>Kills: <span id="finalKills">0</span></p>
                    <p>Deaths: <span id="finalDeaths">0</span></p>
                    <p>Money Earned: <span id="finalMoney">$0</span></p>
                </div>
                <button class="restart-button" onclick="location.reload()">Continue to Next Round</button>
            </div>
        </div>
    </div>

    <script>
        const canvas = document.getElementById('gameCanvas');
        const ctx = canvas.getContext('2d');

        function resizeCanvas() {
            const container = canvas.parentElement;
            canvas.width = container.clientWidth;
            canvas.height = container.clientHeight;
        }
        resizeCanvas();
        window.addEventListener('resize', resizeCanvas);

        const gameState = {
            round: 1,
            team: 'T',
            health: 100,
            maxHealth: 100,
            ammo: 30,
            maxAmmo: 120,
            kills: 0,
            deaths: 0,
            money: 2400,
            weapon: 'm4a1',
            isAlive: true,
            isReloading: false,
            gameOver: false
        };

        const weapons = {
            m4a1: { damage: 25, fireRate: 600, reloadTime: 3000, ammoCapacity: 30, range: 1000 },
            ak47: { damage: 40, fireRate: 1500, reloadTime: 2300, ammoCapacity: 30, range: 1000 },
            awp: { damage: 140, fireRate: 1000, reloadTime: 3000, ammoCapacity: 10, range: 1000 }
        };

        class Entity {
            constructor(x, y, width, height) {
                this.x = x;
                this.y = y;
                this.width = width;
                this.height = height;
                this.velocityX = 0;
                this.velocityY = 0;
                this.isJumping = false;
            }

            draw() {
                ctx.fillStyle = this.color || '#fff';
                ctx.fillRect(this.x, this.y, this.width, this.height);
            }

            update() {
                this.x += this.velocityX;
                this.y += this.velocityY;
                
                if (this.y + this.height > canvas.height) {
                    this.y = canvas.height - this.height;
                    this.isJumping = false;
                    this.velocityY = 0;
                }

                if (this.y < 0) {
                    this.y = 0;
                    this.velocityY = 0;
                }

                if (this.x < 0) this.x = 0;
                if (this.x + this.width > canvas.width) this.x = canvas.width - this.width;

                if (!this.isJumping) {
                    this.velocityY = 0;
                } else {
                    this.velocityY += 0.5;
                }
            }
        }

        class Player extends Entity {
            constructor(x, y, team) {
                super(x, y, 20, 30);
                this.team = team;
                this.health = 100;
                this.angle = 0;
                this.color = team === 'T' ? '#ff9900' : '#3399ff';
            }

            draw() {
                ctx.save();
                ctx.fillStyle = this.color;
                ctx.fillRect(this.x, this.y, this.width, this.height);
                
                ctx.strokeStyle = '#fff';
                ctx.lineWidth = 2;
                ctx.strokeRect(this.x, this.y, this.width, this.height);
                
                ctx.restore();
            }

            takeDamage(amount) {
                this.health -= amount;
                addDamageIndicator(this.x, this.y, amount);
                if (this.health <= 0) {
                    this.health = 0;
                    return true;
                }
                return false;
            }
        }

        class Enemy extends Player {
            constructor(x, y, team) {
                super(x, y, team);
                this.targetX = Math.random() * canvas.width;
                this.targetY = Math.random() * canvas.height;
                this.moveSpeed = 2;
                this.shootCooldown = 0;
                this.chaseDistance = 300;
            }

            update() {
                super.update();
                
                const distToPlayer = Math.hypot(gameState.playerX - this.x, gameState.playerY - this.y);
                
                if (distToPlayer < this.chaseDistance) {
                    this.targetX = gameState.playerX;
                    this.targetY = gameState.playerY;
                } else {
                    if (Math.random() < 0.02) {
                        this.targetX = Math.random() * canvas.width;
                        this.targetY = Math.random() * canvas.height;
                    }
                }

                const dx = this.targetX - this.x;
                const dy = this.targetY - this.y;
                const dist = Math.hypot(dx, dy);

                if (dist > 5) {
                    this.velocityX = (dx / dist) * this.moveSpeed;
                    this.velocityY = (dy / dist) * this.moveSpeed;
                } else {
                    this.velocityX *= 0.95;
                    this.velocityY *= 0.95;
                }

                if (this.shootCooldown > 0) this.shootCooldown--;

                if (distToPlayer < 600 && this.shootCooldown === 0) {
                    this.shootAtPlayer();
                    this.shootCooldown = 30;
                }
            }

            shootAtPlayer() {
                const angle = Math.atan2(gameState.playerY - this.y, gameState.playerX - this.x);
                const projectile = {
                    x: this.x + this.width / 2,
                    y: this.y + this.height / 2,
                    vx: Math.cos(angle) * 5,
                    vy: Math.sin(angle) * 5,
                    damage: 15,
                    owner: 'enemy'
                };
                enemyProjectiles.push(projectile);
            }
        }

        let gameState_playerX = 50;
        let gameState_playerY = canvas.height / 2;
        Object.defineProperty(gameState, 'playerX', {
            get: () => gameState_playerX,
            set: (v) => gameState_playerX = v
        });
        Object.defineProperty(gameState, 'playerY', {
            get: () => gameState_playerY,
            set: (v) => gameState_playerY = v
        });

        const player = new Player(gameState_playerX, gameState_playerY, gameState.team);
        const enemies = [];
        const projectiles = [];
        const enemyProjectiles = [];
        let mouseX = canvas.width / 2;
        let mouseY = canvas.height / 2;
        let lastShotTime = 0;
        let keys = {};

        function spawnEnemies(count = 3 + gameState.round) {
            for (let i = 0; i < count; i++) {
                const x = Math.random() * canvas.width;
                const y = Math.random() * canvas.height;
                enemies.push(new Enemy(x, y, gameState.team === 'T' ? 'CT' : 'T'));
            }
        }

        function addDamageIndicator(x, y, damage) {
            const indicator = document.createElement('div');
            indicator.className = 'damage-indicator';
            indicator.textContent = `-${Math.floor(damage)}`;
            indicator.style.left = x + 'px';
            indicator.style.top = y + 'px';
            document.getElementById('hitIndicator').appendChild(indicator);
            setTimeout(() => indicator.remove(), 1000);
        }

        function addChatMessage(msg) {
            const container = document.getElementById('chatContainer');
            const message = document.createElement('div');
            message.className = 'chat-message';
            message.textContent = msg;
            container.appendChild(message);
            setTimeout(() => message.remove(), 3000);
        }

        function showStatus(title, text, duration = 3000) {
            const element = document.getElementById('statusMessage');
            document.getElementById('statusTitle').textContent = title;
            document.getElementById('statusText').textContent = text;
            element.style.display = 'block';
            setTimeout(() => {
                element.style.display = 'none';
            }, duration);
        }

        function updateUI() {
            document.getElementById('health').textContent = gameState.health;
            document.getElementById('ammo').textContent = `${gameState.ammo}/${gameState.maxAmmo}`;
            document.getElementById('kills').textContent = gameState.kills;
            document.getElementById('deaths').textContent = gameState.deaths;
            document.getElementById('money').textContent = `$${gameState.money}`;
            document.getElementById('round').textContent = gameState.round;
            
            const teamEl = document.getElementById('team');
            teamEl.textContent = gameState.team;
            teamEl.className = 'ui-value team-indicator ' + (gameState.team === 'T' ? 'team-t' : 'team-ct');
        }

        function draw() {
            ctx.fillStyle = 'rgba(15, 52, 96, 0.8)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            ctx.strokeStyle = '#ff4500';
            ctx.lineWidth = 1;
            ctx.strokeRect(0, 0, canvas.width, canvas.height);

            player.draw();

            enemies.forEach(enemy => {
                enemy.draw();
                ctx.fillStyle = '#ff0000';
                ctx.fillRect(enemy.x, enemy.y - 10, enemy.width, 5);
                ctx.fillStyle = '#00ff00';
                ctx.fillRect(enemy.x, enemy.y - 10, (enemy.health / 100) * enemy.width, 5);
            });

            projectiles.forEach((proj, idx) => {
                ctx.fillStyle = '#ffaa00';
                ctx.beginPath();
                ctx.arc(proj.x, proj.y, 3, 0, Math.PI * 2);
                ctx.fill();
            });

            enemyProjectiles.forEach((proj, idx) => {
                ctx.fillStyle = '#ff4444';
                ctx.beginPath();
                ctx.arc(proj.x, proj.y, 3, 0, Math.PI * 2);
                ctx.fill();
            });

            ctx.strokeStyle = '#ff4500';
            ctx.lineWidth = 2;
            ctx.beginPath();
            const gunLength = 20;
            const angle = Math.atan2(mouseY - gameState.playerY, mouseX - gameState.playerX);
            const gunX = gameState.playerX + Math.cos(angle) * gunLength;
            const gunY = gameState.playerY + Math.sin(angle) * gunLength;
            ctx.moveTo(gameState.playerX + player.width / 2, gameState.playerY + player.height / 2);
            ctx.lineTo(gunX, gunY);
            ctx.stroke();
        }

        function update() {
            player.x = gameState.playerX;
            player.y = gameState.playerY;

            player.velocityX = 0;
            player.velocityY = 0;

            if (keys['w'] || keys['ArrowUp']) {
                player.velocityY = -3;
            }
            if (keys['s'] || keys['ArrowDown']) {
                player.velocityY = 3;
            }
            if (keys['a'] || keys['ArrowLeft']) {
                player.velocityX = -3;
            }
            if (keys['d'] || keys['ArrowRight']) {
                player.velocityX = 3;
            }

            if (keys[' '] && !player.isJumping) {
                player.velocityY = -10;
                player.isJumping = true;
            }

            player.update();
            gameState.playerX = player.x;
            gameState.playerY = player.y;

            enemies.forEach(enemy => {
                enemy.update();
            });

            projectiles.forEach((proj, idx) => {
                proj.x += proj.vx;
                proj.y += proj.vy;

                enemies.forEach((enemy, enemyIdx) => {
                    const dist = Math.hypot(proj.x - enemy.x, proj.y - enemy.y);
                    if (dist < enemy.width) {
                        if (enemy.takeDamage(proj.damage)) {
                            enemies.splice(enemyIdx, 1);
                            gameState.kills++;
                            gameState.money += 300;
                            addChatMessage('Enemy eliminated!');
                        }
                        projectiles.splice(idx, 1);
                    }
                });

                if (proj.x < 0 || proj.x > canvas.width || proj.y < 0 || proj.y > canvas.height) {
                    projectiles.splice(idx, 1);
                }
            });

            enemyProjectiles.forEach((proj, idx) => {
                proj.x += proj.vx;
                proj.y += proj.vy;

                const playerDist = Math.hypot(proj.x - gameState.playerX, proj.y - gameState.playerY);
                if (playerDist < 15) {
                    gameState.health -= proj.damage;
                    enemyProjectiles.splice(idx, 1);
                    if (gameState.health <= 0) {
                        gameState.isAlive = false;
                        gameState.health = 0;
                        gameState.deaths++;
                        endRound(false);
                    }
                }

                if (proj.x < 0 || proj.x > canvas.width || proj.y < 0 || proj.y > canvas.height) {
                    enemyProjectiles.splice(idx, 1);
                }
            });

            if (enemies.length === 0 && gameState.isAlive) {
                endRound(true);
            }

            updateUI();
        }

        function endRound(won) {
            gameState.gameOver = true;
            document.getElementById('gameOverScreen').classList.add('active');
            document.getElementById('gameOverTitle').textContent = won ? 'ROUND WON!' : 'ROUND LOST';
            document.getElementById('finalKills').textContent = gameState.kills;
            document.getElementById('finalDeaths').textContent = gameState.deaths;
            document.getElementById('finalMoney').textContent = '$' + gameState.money;
            
            if (won) {
                gameState.money += 1400;
                showStatus('ROUND WON', 'Enemies eliminated! Preparing next round...', 3000);
                addChatMessage('[SERVER] CT Victory! All terrorists eliminated!');
            } else {
                gameState.money = Math.max(1400, gameState.money);
                showStatus('ROUND LOST', 'You have been eliminated', 3000);
                addChatMessage('[SERVER] Terrorist Victory!');
            }
        }

        function gameLoop() {
            if (!gameState.gameOver) {
                update();
                draw();
            }
            requestAnimationFrame(gameLoop);
        }

        canvas.addEventListener('mousemove', (e) => {
            const rect = canvas.getBoundingClientRect();
            mouseX = e.clientX - rect.left;
            mouseY = e.clientY - rect.top;
        });

        canvas.addEventListener('click', () => {
            if (gameState.gameOver || !gameState.isAlive) return;
            
            const now = Date.now();
            const weapon = weapons[gameState.weapon];
            if (now - lastShotTime > weapon.fireRate && gameState.ammo > 0) {
                lastShotTime = now;
                gameState.ammo--;

                const angle = Math.atan2(mouseY - gameState.playerY, mouseX - gameState.playerX);
                const spread = (Math.random() - 0.5) * 0.3;
                const finalAngle = angle + spread;

                const projectile = {
                    x: gameState.playerX + Math.cos(finalAngle) * 15,
                    y: gameState.playerY + Math.sin(finalAngle) * 15,
                    vx: Math.cos(finalAngle) * 6,
                    vy: Math.sin(finalAngle) * 6,
                    damage: weapon.damage
                };
                projectiles.push(projectile);

                addChatMessage('Shot fired');
            }
        });

        document.addEventListener('keydown', (e) => {
            keys[e.key.toLowerCase()] = true;
            if (e.key.toLowerCase() === 'r' && !gameState.isReloading) {
                gameState.isReloading = true;
                addChatMessage('Reloading...');
                setTimeout(() => {
                    gameState.ammo = weapons[gameState.weapon].ammoCapacity;
                    gameState.isReloading = false;
                    addChatMessage('Reload complete');
                }, weapons[gameState.weapon].reloadTime);
            }
        });

        document.addEventListener('keyup', (e) => {
            keys[e.key.toLowerCase()] = false;
        });

        showStatus('GET READY', 'Round ' + gameState.round + ' starting!', 2000);
        spawnEnemies();
        updateUI();
        gameLoop();
    </script>
</body>
</html>
