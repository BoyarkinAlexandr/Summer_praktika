$(document).ready(() => {
    class AnimationOpenJQ{
        constructor(btn, block){
            this.block = block;
            this.mode = false;
            this.block.css({
                'right': '-100vw',
                'display': 'block',
            });
        }

        functionOpen(){
            this.block.animate(() => {

            }, 500);
        }

    }
    new AnimationOpenJQ($('#cart-icon'),$('.cart__container'));
});