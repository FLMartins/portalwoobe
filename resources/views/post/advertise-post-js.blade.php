@if(env('APP_ENV')=='production')
var oldDocumentWrite = document.write;
// change document.write temporary
document.write = function(node){
    $("#conteudo-posts").append(node)
}

// 720x90 
var scriptBox1 = document.createElement('script');
scriptBox1.type = 'text/javascript';
scriptBox1.text = '<!-- coddisplaysupplier="cb60db1545f542df9a467e44a8b2fd0d";formatId="55";numads="1";type="14";idtShape="55";category="24,46,17,47,19,18,25,20";altColor="FFFFFF"; -->';
var scriptBox2 = document.createElement('script');
scriptBox2.type = 'text/javascript';
scriptBox2.src = 'http://adrequisitor-af.uol.com.br/uolafhost.js';
var adBanner = document.createElement('div');
adBanner.className = 'ad-woobe-post-content-banner';
adBanner.appendChild(scriptBox1);
adBanner.appendChild(scriptBox2);


// 250x250 
var scriptBox1 = document.createElement('script');
scriptBox1.type = 'text/javascript';
scriptBox1.text = '<!-- coddisplaysupplier="cb60db1545f542df9a467e44a8b2fd0d";formatId="127";numads="1";type="20";idtShape="127";category="50,49,48,53";idtUrl="300725";altColor="FFFFFF"; -->';
var scriptBox2 = document.createElement('script');
scriptBox2.type = 'text/javascript';
scriptBox2.src = '//jsuol.com/p/afiliados/adrequisitor/uolafpagseguro.js';
var adBox = document.createElement('div');
adBox.className = 'ad-woobe-post-content-box';
adBox.appendChild(scriptBox1);
adBox.appendChild(scriptBox2);

var adWrapper = document.createElement('div');
adWrapper.id = 'ad-woobe-post-wrapper';
adWrapper.appendChild(adBanner);
adWrapper.appendChild(adBox);

var posts = document.getElementById('conteudo-posts');
posts.appendChild(adWrapper);

document.write = oldDocumentWrite;

@else
//Local enviroment....do nothing.
@endif