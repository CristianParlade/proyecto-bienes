<main>
    <h1>Crear Vendedor</h1>
    <a class="boton-verde" href="/admin">Volver</a>
    <?php foreach($errores as $error): ?>
            <div class="alerta error"> 
                <?php echo $error;?>
           </div>
    <?php endforeach;?>
    <form class="formulario" method="POST">
        <?php include 'formulario.php'?>
        <input type="submit" value="Crear Vendedor" class="boton boton-verde">
    </form>
</main>