<!DOCTYPE html>
  <html lang="pt-br">

    <head>

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        <style>
          *{
            color: aliceblue;
          }
            body{
              background-color: #003948;
            }

            h1, p, label{
              display: block;
              text-align: center;  
            }
            form{
              margin-left: auto;
              margin-right: auto;
            }
            .btsubmit{
              background-color: #2b5a88;
              color: aliceblue;
              border: none;
            }
            .main{
              max-width: 600px;
            }
          
        </style>
    </head>
      <body>

        <div class="container mt-5 main">
          
        <h1>Consulta CNPJ</h1>
        <p>Sua ferramenta para consultar dados e informações de empresas!</p>
          <form action="consultar.php">

            <label for="inputPassword5" class="form-label">Insira o cnpj para a busca: </label>
            <input class="form-control mb-1" type="text" name="Cnpj" maxlength="14" minlength="14" pattern="[0-9]{14}" title="O CNPJ tem que conter 14 dígitos e somente números">
            <input class="form-control btsubmit" type="submit">

          </form>

        </div>

      </body>
  </html>
