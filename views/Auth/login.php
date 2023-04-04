<main class="contenedor seccion">
        <h1>Iniciar Sesión</h1>
                <?php foreach($errores as $error):?>
                <div class="alerta error">
                <?php echo $error;?>
                </div>
                <?php endforeach;?>
        <form class="formulario" method="POST" action="/login">
            <fieldset>
                
                <legend>Email y Password</legend>
               
                <label for="email">Email</label>
                <input type="email" placeholder="Escribe tu email" name="email" id="email" >

                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Tu Password" >

                <input type="submit" class="centrado boton-verde" value="Iniciar Sesión">
            </fieldset>
        </form>
    </main>
