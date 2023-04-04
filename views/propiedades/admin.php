
<main class="contenedor seccion">
    <h1>Admin</h1>
    <?php if($resultado) {?>
    <?php $mensaje = mostrarNotificacion(intval($resultado))?>
    <?php if ($mensaje) {?>
    <p class="alerta exito"><?php echo s($mensaje)?></p>
    <?php }?>
    <?php }?>

    <a class="boton-amarillo" href="./propiedades/crear">crear Propiedad</a>
    
    <table class="propiedades">
        <h2>PROPIEDADES</h2>
        <thead>

            <tr>
                <th>ID</th>
                <th>TITULO</th>
                <th>IMAGEN</th>
                <th>PRECIO</th>
                <th>ACCIONES</th>
            </tr>

        </thead>
        <tbody> <!--Mostrar los resultados-->
            <?php foreach($propiedades as $propiedad) :?>
                <tr class="tbody">
                    <td><?php echo $propiedad->id;?></td>
                    <td><?php echo $propiedad->titulo;?></td>
                    <td><img src="../imagenes/<?php echo $propiedad->imagen?>" class="imagen-tabla"></td>
                    <td>$ <?php echo $propiedad->precio?></td>
                    <td>
                        <form method="POST" class="w-100" action="/propiedades/eliminar">
                        
                        <input type="hidden" name="id" value=" <?php echo $propiedad->id; ?>">
                        <input type="hidden" name="from" value="propiedad">
                        <input type="submit"  class="boton-rojo-block" value="Eliminar">
                        </form>
                       
                        <a class="boton-amarillo-block" href="/propiedades/actualizar?id=<?php echo $propiedad->id;?>">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <table class="propiedades">
   <h2>VENDEDORES</h2>
         <a class="boton boton-verde" href="./vendedores/crear">Crear vendedor</a>
        <thead>

            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>TELEFONO</th>
                <th>ACCIONES</th>
            </tr>

        </thead>
        <tbody> <!--Mostrar los resultados-->
            <?php foreach($vendedores as $vendedor) :?>
                <tr class="tbody">
                    <td><?php echo $vendedor->id;?></td>
                    <td><?php echo $vendedor->nombre . " " .  $vendedor->apellido ;?></td>
                    <td><?php echo $vendedor->telefono?></td>
                    <td>
                        <form method="POST" class="w-100" action="/vendedores/eliminar">
                        
                        <input type="hidden" name="id" value=" <?php echo $vendedor->id; ?>">
                        <input type="hidden" name="from" value="vendedores">
                        <input type="submit"  class="boton-rojo-block" value="eliminar">
                        </form>
                       
                        <a class="boton-amarillo-block" href="/vendedores/actualizar?id=<?php echo $vendedor->id;?>">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>