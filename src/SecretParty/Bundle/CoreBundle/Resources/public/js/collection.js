
/*
    Copyright (C) 2014 Hugo DJEMAA / Jérémie BOUTOILLE / Mickael GOUBIN /
    David LIVET - http://github.com/SecretParty/serverPHP
                                        
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see [http://www.gnu.org/licenses/].
*/

function addSecretForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a secret" link li
    var $newFormLi = $('<li></li>').append(newForm);
    addSecretFormDeleteLink($newFormLi);
    $newLinkLi.before($newFormLi);
}

function addSecretFormDeleteLink($secretFormLi) {
    var $removeFormA = $('<a href="#">delete this secret</a>');
    $secretFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the secret form
        $secretFormLi.remove();
    });
}

var $collectionHolder;

// setup an "add a secret" link
var $addsecretLink = $('<a href="#" class="add_secret_link">Add a secret</a>');
var $newLinkLi = $('<li></li>').append($addsecretLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of secrets
    $collectionHolder = $('ul.secrets');

    // add a delete link to all of the existing secret form li elements
    $collectionHolder.find('li.secret').each(function() {
        addSecretFormDeleteLink($(this));
    });

    // add the "add a secret" anchor and li to the secrets ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addsecretLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new secret form (see next code block)
        addSecretForm($collectionHolder, $newLinkLi);
    });
});