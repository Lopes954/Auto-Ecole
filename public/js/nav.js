const stat1 = document.querySelector('.statistique1');
const stat2 = document.querySelector('.statistique2');
const stat3 = document.querySelector('.statistique3');
const anim = document.querySelector('.avantage1');
const pmd = document.querySelector('.pmd');
const price = document.querySelector('.price');
const btncenter = document.querySelector('.boutoncenter');
const btndoc = document.querySelector('.doc');



const TL1 = gsap.timeline({paused: true});

TL1 
.to(stat1, {margin: '0px', ease: Power3.easeOut, duration: 0.5})
.to(stat2, {margin: '0px', ease: Power3.easeOut, duration: 0.5})
.to(stat3, {margin: '0px', ease: Power3.easeOut, duration: 0.5})
.from(pmd, {y: -50, opacity: 0, ease: Power3.easeOut, duration: 0.1})
.from(price, {y: -50, opacity: 0, ease: Power3.easeOut, duration: 1})
.from(anim, {y: -50, opacity: 0, ease: Power3.easeOut, duration: 1})
.staggerFrom(btncenter, 1, {opacity: 0}, 0.2, '-=0.30')
.staggerFrom(btndoc, 1, {opacity: 0}, 0.2, '-=0.30')




window.addEventListener('load', () => {
    TL1.play();
})


//vague

// const carte = document.querySelectorAll('#containertarif30')
// const controller = new ScrollMagic.Controller();


// const tlVoyage = new TimelineMax();

// tlVoyage
// .staggerFrom(carte, 1, {opacity: 0}, 0.2, '-=0.5')

// const scene = new ScrollMagic.Scene({
//     triggerElement: carte,
//     triggerHook: 0.7,
//     reverse: true
// })
// .setTween(tlVoyage)
// // .addIndicators()
// .addTo(controller)