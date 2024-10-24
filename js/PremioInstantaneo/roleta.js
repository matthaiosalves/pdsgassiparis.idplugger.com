const rootStyles = getComputedStyle(document.documentElement);
const primaryColor = rootStyles.getPropertyValue('--primary').trim();
const secondaryColor = rootStyles.getPropertyValue('--secondary').trim();

const canvas = document.getElementById('wheel');
const ctx = canvas.getContext('2d');
const spinButton = document.getElementById('spinButton');
const winningIndex = document.getElementById('winningIndex').value;

const options = [
    "NÃO GANHOU",
    "GANHOU",
    "NÃO GANHOU",
    "GANHOU",
    "NÃO GANHOU",
    "GANHOU",
    "NÃO GANHOU",
    "GANHOU"
];

const colors = [
    primaryColor,  // Cor primaria
    secondaryColor // Cor secundaria
];

const textColors = [
    "#FFFFFF", // Rosa para "NÃO GANHOU"
    "#FFFFFF"  // Branco para "GANHOU"
];

const numOptions = options.length;
const arcSize = (2 * Math.PI) / numOptions;
let startAngle = 0;

function drawWheel() {
    options.forEach((option, index) => {
        const angle = startAngle + index * arcSize;
        ctx.beginPath();
        ctx.arc(250, 250, 250, angle, angle + arcSize);
        ctx.lineTo(250, 250);
        ctx.fillStyle = colors[index % 2];
        ctx.fill();
        ctx.stroke();

        ctx.save();
        ctx.translate(250, 250);
        ctx.rotate(angle + arcSize / 2);
        ctx.textAlign = "right";
        ctx.fillStyle = option === "NÃO GANHOU" ? textColors[0] : textColors[1];
        ctx.font = "bold 16px Arial";
        ctx.fillText(option, 230, 10);
        ctx.restore();
    });
}

function spinWheel(winningIndex) {
    const duration = 5000; // Duration of the spin in milliseconds
    const rotations = Math.floor(Math.random() * 3) + 4; // Random rotations between 4 and 6
    const finalAngle = (numOptions - winningIndex) * arcSize - arcSize / 2;

    const totalRotation = rotations * 2 * Math.PI + finalAngle;
    const startTime = performance.now();

    function animate() {
        const currentTime = performance.now();
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);

        startAngle = totalRotation * easeOutCubic(progress);

        ctx.clearRect(0, 0, canvas.width, canvas.height);
        drawWheel();

        if (progress < 1) {
            requestAnimationFrame(animate);
        } else {
            $('#instrucoes').removeClass('d-none');
            $('#btnContinuar').removeClass('d-none');
            //alert(`A opção sorteada é: ${options[winningIndex]}`);
        }
    }

    animate();
}

function easeOutCubic(t) {
    return (--t) * t * t + 1;
}

drawWheel();

spinButton.addEventListener('click', () => {
    $("#spinButton").fadeOut(500);
    spinWheel(winningIndex);
});
