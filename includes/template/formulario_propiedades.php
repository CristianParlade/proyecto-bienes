
     
<fieldset>
        <legend>Información General</legend>
       
        <label for="titulo">TITULO:</label>                                                   
        <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo Propiedad" value="<?php echo s($propiedad->titulo);?>">

        <label for="precio">PRECIO:</label>
        <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?php echo s($propiedad->precio);?>">

        <label for="imagen">IMAGEN:</label>
        <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">
        <?php if($propiedad->imagen) {?>
            <img src="/practica/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-small">
        <?php }?>

        <label for="textarea">DESCRIPCIÓN:</label>
        <textarea id="textarea" name="propiedad[descripcion]"><?php echo s($propiedad->descripcion);?></textarea>
    </fieldset>
    <fieldset>
        <legend>Informacion Propiedad</legend>

        <label for="habitaciones">HABITACIONES::</label>
        <input type="text" id="habitaciones" name="propiedad[habitaciones]" min="1" max="9" placeholder="Ej: 3" value="<?php echo s($propiedad->habitaciones);?>">

        
        <label for="WC">BAÑOS:</label>
        <input type="number" id="WC" name="propiedad[WC]" min="1" max="9" placeholder="Ej: 3" value="<?php echo s($propiedad->WC);?>"
           
        <label for="estacionamiento">ESTACIONAMIENTO::</label>
        <input type="text" id="estacionamiento" name="propiedad[estacionamiento]" min="1" max="9" placeholder="Ej: 3" value="<?php echo s($propiedad->estacionamiento);?>">

    </fieldset>

    <fieldset>
        <legend>Vendedor</legend>
            <select name="propiedad[vendedoresId]" id="vendedor">
                <option  value="" selected>--seleccionar--</option>
           
                <?php foreach($vendedores as $vendedor): ?> 
                <option  <?php echo $propiedad->vendedoresId === $vendedor->id  ? '' : 'selected';?> value="<?php echo s($vendedor->id); ?>"> <?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?> </option>
                <?php endforeach;?>

            </select>
       
    </fieldset>