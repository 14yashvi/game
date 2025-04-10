<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whack A Mole</title>
    <style>
        #game-board {
            display: grid;
            grid-template-columns: repeat(3, 100px);
            grid-template-rows: repeat(3, 100px);
            gap: 10px;
            justify-content: center;
        }
        .hole {
            width: 100px;
            height: 100px;
            background-color: #6e4f27;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            color: white;
            cursor: pointer;
        }
        .mole {
            background-color: green;
        }
        #score, #timer {
            text-align: center;
            font-size: 20px;
        }
        #startButton {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Whack A Mole</h1>
    <div id="score">Score: 0</div>
    <div id="timer">Time: 30s</div>
    <div id="game-board">
        <!-- Holes (buttons) will be dynamically created here -->
    </div>
    <button id="startButton">Start Game</button>

    <script>
        const gridSize = 3;
        const gameDuration = 30;
        let score = 0;
        let timeLeft = gameDuration;
        let moleTimer;
        let gameTimer;
        let molePosition = -1;

        const gameBoard = document.getElementById("game-board");
        const scoreElement = document.getElementById("score");
        const timerElement = document.getElementById("timer");

        // Create the grid
        for (let i = 0; i < gridSize * gridSize; i++) {
            const hole = document.createElement("div");
            hole.classList.add("hole");
            hole.addEventListener("click", () => whackMole(i, hole));
            gameBoard.appendChild(hole);
        }

        function startGame() {
            score = 0;
            timeLeft = gameDuration;
            scoreElement.textContent = "Score: " + score;
            timerElement.textContent = "Time: " + timeLeft + "s";

            moleTimer = setInterval(showMole, 1000);  // Show mole every second
            gameTimer = setInterval(updateTimer, 1000);  // Countdown timer

            document.getElementById("startButton").disabled = true;
        }

        function showMole() {
            // Hide all moles
            const holes = document.querySelectorAll(".hole");
            holes.forEach(hole => hole.classList.remove("mole"));

            // Randomly select a hole to show the mole
            molePosition = Math.floor(Math.random() * holes.length);
            holes[molePosition].classList.add("mole");
        }

        function whackMole(i, hole) {
            if (i === molePosition) {
                score++;
                scoreElement.textContent = "Score: " + score;
                hole.classList.remove("mole");
            }
        }

        function updateTimer() {
            timeLeft--;
            timerElement.textContent = "Time: " + timeLeft + "s";
            if (timeLeft <= 0) {
                clearInterval(gameTimer);
                clearInterval(moleTimer);
                alert("Game Over! Final Score: " + score);
                document.getElementById("startButton").disabled = false;
            }
        }

        document.getElementById("startButton").addEventListener("click", startGame);
    </script>
</body>
</html>
