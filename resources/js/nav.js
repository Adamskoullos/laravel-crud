document.addEventListener('DOMContentLoaded', ()=> {
    
    // Manage visibility of nav on scroll --------------------------------------
    // Nav to slide out on scroll down and slide in on scroll up

    // 1. identify if user is scrolling up or down on the page
    let previousScrollPosition = 0;

    const isScrollingDown = () =>{
        let currentScrollPosition = window.scrollY || window.pageYOffset;
        let scrollingDown;

        if(currentScrollPosition > previousScrollPosition){
            scrollingDown = true;
        } else{
            scrollingDown = false;
        }

        previousScrollPosition = currentScrollPosition;

        return scrollingDown;
    }

    // 2. Logic to add and remove classes dependng on if user is scrolling up or down
    const nav = document.querySelector('nav');

    const handleNavScroll = () =>{
        if(isScrollingDown()){
            nav.classList.add('scroll-down');
            nav.classList.remove('scroll-up');
        } else{
            nav.classList.add('scroll-up');
            nav.classList.remove('scroll-down');
        }
    }

    // 3. Create a throttle for 250ms to prevent the above function from being fired on every scroll event 
    let throttleWait;

    const throttle = (callback, time) => {
        // if the variable is true, don't run the function
        if (throttleWait) return;
      
        // set the wait variable to true to pause the function
        throttleWait = true;
      
        // setTimeout to run the function after 250ms
        setTimeout(() => {
          callback();
      
          // set throttleWait to false once the timer is up to restart the throttle function
          throttleWait = false;
        }, time);
      }

    // 4. Add a scroll event listener to invoke the throttle function passing in the handleNavScroll and delay period:
    window.addEventListener('scroll', ()=>{
        throttle(handleNavScroll, 250);
    });
    // End of nav scroll management ---------------------------------------------------

    // Nav responsive behaviour logic. The below manages the switch between burger menu and the default top nav
    
    const burger = document.querySelector('.burger');
    const menu = document.querySelector('nav ul');

    burger.addEventListener('click', mobileMenu);

    function mobileMenu(){
        burger.classList.toggle('active');
        menu.classList.toggle('active');

        
    }
});

