<!-- si existe $pro -->
<?php if(isset($product)):?>
<h1><?=$product->nombre?></h1>
        <!-- <div class="contenedor-producto produc-unico">  -->
                    <div class="detail-product">
                        <div class="image">
                               <!-- podemos hacer una condicional para que cuando no tenga imagenes coloquemos una por defecto -->
                               <?php if($product->imagen != null):?>
                                <img src="<?=base_url?>uploads/images/product/<?=$product->imagen?>" alt="" />
                                <?php else:?>
                                    <img src="<?=base_url?>assets/img/camiseta.png" alt="" />
                                <?php endif;?>
                        </div>
 
                         <div class="data">
                                <p class="descripcion" ><?=$product->descripcion?></p>
                                <p class="price">S/.<?=$product->precio?></p>
     <a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="button boton-comprar-ver">Comprar</a>
                         </div>               
                    </div>   
        <!-- </div> -->
<?php else: ?>
<h1>el producto no existe</h1>
<?php endif; ?>