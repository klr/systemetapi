<?php
class Tag extends Eloquent
{
    /**
     * Table
     * @var string
     */
    protected $table = 'tag';

    /**
     * Guarded
     * @var array
     */
    protected $guarded = [];

    /**
     * Hidden
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'pivot'];

    /**
     * Mapping
     * @param  string $string
     * @return array
     */
    public static function mapping($string)
    {
        $mapping = [
            'Alkoholfritt, Aperitif och Bitte' => array('non-alcohol', 'apertif'),
            'Alkoholfritt, Cider' => array('non-alcohol', 'cider'),
            'Alkoholfritt, Glögg' => array('non-alcohol', 'mulled-wine', 'wine'),
            'Alkoholfritt, Mousserande' => array('non-alcohol', 'sparkling'),
            'Alkoholfritt, Öl' => array('non-alcohol', 'beer'),
            'Alkoholfritt, Övrigt' => array('non-alcohol'),
            'Alkoholfritt, Rosé' => array('non-alcohol', 'rose', 'wine'),
            'Alkoholfritt, Rött' => array('non-alcohol', 'red-wine', 'wine'),
            'Alkoholfritt, Vatten' => array('non-alcohol', 'water'),
            'Alkoholfritt, Vitt' => array('non-alcohol', 'red-wine', 'wine'),
            'Aniskryddad sprit' => array('liquor'),
            'Aperitif' => array('apertif'),
            'Armagnac' => array('armegnac'),
            'Bitter' => array('bitter', 'ale', 'beer'),
            'Blanddrycker' => array('liquor'),
            'Brandy och Vinsprit, Brandy' => array('brandy'),
            'Brandy och Vinsprit, Vinsprit' => array('brandy'),
            'Calvados' => array('calvados'),
            'Cider' => array('cider'),
            'Cider, Söt' => array('cider', 'sweet'),
            'Cider, Torr och halvtorr' => array('cider', 'dry'),
            'Cognac' => array('cognac'),
            'Drinkar och Cocktails' => array('liquor'),
            'Fruktvin' => array('wine'),
            'Fruktvin, Sött' => array('wine', 'sweet'),
            'Fruktvin, Torrt' => array('wine', 'dry'),
            'Genever' => array('jenever'),
            'Gin' => array('gin'),
            'Glögg och Glühwein' => array('mulled-wine', 'wine'),
            'Grappa och Marc, Grappa' => array('grappa'),
            'Grappa och Marc, Marc' => array('grappa'),
            'Kryddad sprit' => array('liquor'),
            'Likör, Frukter och bär' => array('liquor'),
            'Likör, Grädde och ägg' => array('liquor'),
            'Likör, Kaffe, kakao och nötter' => array('liquor'),
            'Likör, Kryddor och örter' => array('liquor'),
            'Likör, Övrig' => array('liquor'),
            'Madeira, Bual' => array('wine', 'red-wine'),
            'Madeira, Malvoisie/Malmsey' => array('wine', 'red-wine'),
            'Madeira, Övrig' => array('wine', 'red-wine'),
            'Madeira, Sercial' => array('wine', 'red-wine'),
            'Mjöd' => array('mead', 'beer'),
            'Montilla' => array('wine', 'white-wine'),
            'Mousserande vin' => array('wine', 'sparkling'),
            'Mousserande vin, Övrigt' => array('wine', 'sparkling'),
            'Mousserande vin, Rosé' => array('wine', 'rose', 'sparkling'),
            'Mousserande vin, Rött' => array('wine', 'red-wine', 'sparkling'),
            'Mousserande vin, Vitt  halvtorrt' => array('wine', 'white-wine', 'dry', 'sparkling'),
            'Mousserande vin, Vitt sött' => array('wine', 'white-wine', 'sweet', 'sparkling'),
            'Mousserande vin, Vitt torrt' => array('wine', 'white-wine', 'dry', 'sparkling'),
            'Okryddad sprit' => array('liquor'),
            'Öl, Ale' => array('beer', 'ale'),
            'Öl, Flera typer' => array('beer'),
            'Öl, Ljus lager' => array('beer', 'lager'),
            'Öl, Mörk lager' => array('beer', 'lager'),
            'Öl, Porter och Stout' => array('beer', 'stout'),
            'Öl, Specialöl' => array('beer'),
            'Öl, Spontanjäst öl' => array('beer'),
            'Öl, Veteöl' => array('beer'),
            'Övrig sprit' => array('liquor'),
            'Övrigt starkvin' => array('liquor', 'wine'),
            'Portvin, Rosé' => array('rose'),
            'Portvin, Rött' => array('wine', 'red-wine'),
            'Portvin, Vitt' => array('wine', 'white-wine'),
            'Punsch' => array('punsch'),
            'Rom, Ljus' => array('rum'),
            'Rom, Mörk' => array('rum'),
            'Rosévin' => array('rose'),
            'Rött vin' => array('red-wine', 'wine'),
            'Rött vin, Fruktigt & Smakrikt' => array('red-wine', 'wine'),
            'Rött vin, Kryddigt & Mustigt' => array('red-wine', 'wine'),
            'Rött vin, Mjukt & Bärigt' => array('red-wine', 'wine'),
            'Rött vin, Sött' => array('red-wine', 'wine', 'sweet'),
            'Rött vin, Stramt & Nyanserat' => array('red-wine', 'wine'),
            'Sake' => array('sake'),
            'Sherry' => array('sherry', 'wine'),
            'Sherry, Halvtorr' => array('sherry', 'wine'),
            'Sherry, Söt' => array('sherry', 'wine', 'sweet'),
            'Sherry, Torr' => array('sherry', 'wine', 'dry'),
            'Smaksatt sprit' => array('liquor'),
            'Smaksatt vin' => array('wine'),
            'Sprit av frukt' => array('liquor'),
            'Tequila och Mezcal' => array('tequila'),
            'Vermouth, Röd söt' => array('wine', 'vermouth', 'sweet', 'red-wine'),
            'Vermouth, Rosé' => array('wine', 'vermouth', 'rose'),
            'Vermouth, Vit söt' => array('wine', 'vermouth', 'white-wine', 'sweet'),
            'Vermouth, Vit torr' => array('wine', 'vermouth', 'white-wine', 'dry'),
            'Vin av flera typer' => array('wine'),
            'Vitt vin' => array('wine', 'white-wine'),
            'Vitt vin, Halvtorrt, Druvigt & B' => array('wine', 'white-wine', 'dry'),
            'Vitt vin, Halvtorrt, Friskt & Fr' => array('wine', 'white-wine', 'dry'),
            'Vitt vin, Halvtorrt, Lätt & Avru' => array('wine', 'white-wine', 'dry'),
            'Vitt vin, Sött' => array('wine', 'white-wine', 'sweet'),
            'Vitt vin, Torrt, Druvigt & Blomm' => array('wine', 'white-wine', 'dry'),
            'Vitt vin, Torrt, Friskt & Frukti' => array('wine', 'white-wine', 'dry'),
            'Vitt vin, Torrt, Fylligt & Smakr' => array('wine', 'white-wine', 'dry'),
            'Vitt vin, Torrt, Lätt & Avrundat' => array('wine', 'white-wine', 'dry'),
            'Whisky , Blended' => array('whisky', 'blended'),
            'Whisky , Grain' => array('whisky', 'grain'),
            'Whisky , Malt' => array('whisky', 'malt'),
            'Whisky , Övrig' => array('whisky'),
            'Whisky , Rye' => array('whisky', 'rye'),
            'Whisky, Bourbon' => array('whisky', 'bourbon'),
            'Whisky, Malt' => array('whisky', 'malt')
        ];

        if (isset($mapping[$string])) {
            return $mapping[$string];
        }

        return [];
    }

    /**
     * Get by name
     * @param  string $name
     * @return Tag
     */
    public static function getByName($name)
    {
        return self::where('name', $name)->first();
    }
}