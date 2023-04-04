
<fieldset>
        <legend>Información General</legend>
       
        <label for="nombre">nombre:</label>                                                   
        <input type="text" id="nombre" name="vendedores[nombre]" placeholder="Obligatorio    *" value="<?php echo s($vendedores->nombre);?>">
       
        <label for="apellido">apellido:</label>                                                   
        <input type="text" id="apellido" name="vendedores[apellido]" placeholder="Obligatorio    *" value="<?php echo s($vendedores->apellido);?>">
       
        <label for="telefono">telefono:</label>                                                   
        <input type="number" id="telefono" name="vendedores[telefono]" placeholder="Obligatorio    *" value="<?php echo s($vendedores->telefono);?>">
       
   </fieldset>