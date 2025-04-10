<div x-data="{ showGoTop: false }" x-init="window.addEventListener('scroll', () => {
    showGoTop = window.scrollY > 200;
})">
    <a href="#" 
        x-show="showGoTop" 
        x-transition 
        class="z-50 fixed bottom-14 right-14 text-brandGray-normal hidden md:w-[60px] md:h-[60px] md:flex justify-center items-center rounded-full border-2 border-brandGray-normal bg-brandGray-lightLight hover:bg-brandRed-normal hover:text-brandGray-lightLight hover:border-0 active:opacity-80">
        top
    </a>
</div>
