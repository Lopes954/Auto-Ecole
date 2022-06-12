const titre50 = document.querySelector('.titre50');

let typewriter = new Typewriter(titre50,  {
    loop: false,
    deleteSpeed: 20
})

typewriter 
.pauseFor(1000)
.changeDelay(20)
.typeString('<i class="fas fa-font emote"><span style="color: #f8f9fa;">UTO ECOLE-95 </span> ')
.pauseFor(500)
.typeString(' Notre seul but ')
.pauseFor(500)
.typeString('<span style="color: #27ae60;"><strong>VOTRE REUSSITE</strong></span> !')



.start()