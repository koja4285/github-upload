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
            imgSrc = '/img/smug1.jpg';
            break;

        case 'smug2':
            imgSrc = '/img/smug2.jpg';
            break;

        case 'smile':
            imgSrc = '/img/smile.jpg';
            break;

        case 'formal':
        default:
            imgSrc = '/img/formal.jpg';
            break;
            
    }

    document.getElementById('photoOfMe').src = imgSrc;
}
