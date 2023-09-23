import JSConfetti from 'js-confetti';
import './bootstrap';


const jsConfetti = new JSConfetti()
window.confetti = () => jsConfetti.addConfetti();
