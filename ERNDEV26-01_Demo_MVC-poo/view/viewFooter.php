<?php
namespace View;

use View\View;

class ViewFooter {
    //ATTRIBUT
    private ?string $buffer;

    //METHODS
    //methode de mise en mémoire tampon
    public function launchBuffer():self{
        ob_start(); //Mise en mémoire tampon (buffer)
?>
            <footer>
               <p> <?php echo "Salut le Monde !" ?> </p>
            </footer>
        </body>
        </html>
<?php 
        $this->buffer = ob_get_clean(); //récupération le contenu du buffer et j'efface le buffer

        return $this;
    }
    public function display(){
        echo $this->buffer;
    }
    
}

