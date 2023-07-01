$(document).ready(() => {
    class AnimationOpenJQ{
        constructor(btn, block){
            this.block = block;
            this.mode = false;
            this.btn = btn;
            this.btn.on('click', () => {
                this.triger();
            })
        }

        triger(){
            if (this.mode){
                this.block.hide(500);
                this.mode = !this.mode;
            } else {
                this.block.show(500);
                this.mode = !this.mode;
            }
        }

    }
    new AnimationOpenJQ($('#cart-icon-card'),$('.cart__container'));
    new AnimationOpenJQ($('#cart-icon-favorietes'),$('.favorietes__container'));
});