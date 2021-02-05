/**
 * Script for home page.
 *
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @author    Kohei Koja
 */


/**
 * Change photos of me based on the radio buttons checked.
 */
function changePhoto(face)
{
    var imgSrc;
    switch (face)
    {
        case 'smug1':
            imgSrc = '/img/home/smug1.jpg';
            break;

        case 'smug2':
            imgSrc = '/img/home/smug2.jpg';
            break;

        case 'smug3':
            imgSrc = '/img/home/smug3.jpg';
            break;

        case 'huh':
            imgSrc = '/img/home/happyHalloween.jpg';
            break;

        case 'dream':
            imgSrc = '/img/home/idealDoppelganger.jpg';
            break;
    
        case 'smile':
            imgSrc = '/img/home/smile.jpg';
            break;
        
        case 'formal':
        default:
            imgSrc = '/img/home/formal.jpg';
            break;
            
    }

    document.getElementById('photoOfMe').src = imgSrc;
}
