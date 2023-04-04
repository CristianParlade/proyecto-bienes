
<main>
    <h1>Actualizar Vendedor</h1>
    <a class="boton-verde" href="/admin">Volver</a>
    <?php foreach($errores as $error): ?>
            <div class="alerta error"> 
                <?php echo $error;?>
           </div>
    <?php endforeach;?>
    <form class="formulario" method="POST">
        <?php include 'formulario.php'?>
        <input type="submit" value="Actualizar Vendedor" class="boton boton-verde">
    </form>
</main>