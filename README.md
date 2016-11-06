# KSchmidExtendListingProperties

### Installation: 

Plugin installieren und einmal sämtliche Caches löschen.

###Konfigurationsparameter

Es werden keine Konfigurationsparameter benötigt!

### Zugriff auf die erweiterten Eigenschaften im Listing

Die Erweiterung erweitert den ListProductService von Shopware um das Auslesen sämtlicher erweiterter Artikeleigenschafen. 
Der Zugriff auf die Eigenschaften kann per smarty über folgenden Tag passieren.<br/>

    {$sArticleProperties = $sArticle.attributes.kschmidExtendListing->get('productProperties')}

Im Anschluss enhält die Variable <b>$sArticleProperties</b> sämtliche Eigenschaftsgruppen, die im Anschluss durch 
iteriert werden können. Zu diesem Zeitpunkt stehen einem sämtliche Funktionen der Struct-Klassen zur Verfügung. Die Variable $propertyGroup besitzt nun alle Funktionen der Klasse:

    \Shopware\Bundle\StoreFrontBundle\Struct\Property\Group
    
Ab hier kann jeder selbst mit der Variable weiterarbeiten. Ein Beispiel ist weiter unten aufgeführt. 

### Beispielaufruf komplett aus Frontend im Listing
    {if $sArticle.attributes.kschmidExtendListing}
            {$sArticleProperties = $sArticle.attributes.kschmidExtendListing->get('productProperties')}
            {foreach $sArticleProperties as $propertyGroup}
                  {if $propertyGroup->getName() == "Zutaten" || $propertyGroup->getName() == "Inhalt"}
                          <h1>{$propertyGroup->getName()}</h1>
                          {$myOptions = ""}
                          {foreach $propertyGroup->getOptions() as $propertyOption}
                                  {$myOptions = $myOptions|cat: $propertyOption->getName()|cat:", "}
                          {/foreach}
                          {$lengthOpt = $myOptions|count_characters - 1}
                          <h2>{$myOptions|substr:0:$lengthOpt}</h2>
                  {/if}
            {/foreach}
    {/if}