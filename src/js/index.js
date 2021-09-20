import '../sass/style.scss';
import 'share-this/style/scss/share-this.scss';

import { Tooltip, Toast, Tab, Scrollspy, Popover, Offcanvas, Modal, Dropdown, Collapse, Carousel, Button, Alert } from 'bootstrap';
import Sharer from 'sharer.js';
import Pace from 'pace-js'

import { library, dom } from '@fortawesome/fontawesome-svg-core';

import { faEnvelope } from '@fortawesome/free-solid-svg-icons/faEnvelope';
import { faSearch } from '@fortawesome/free-solid-svg-icons/faSearch';
import { faBars } from '@fortawesome/free-solid-svg-icons/faBars';
import { faShoppingCart } from '@fortawesome/free-solid-svg-icons/faShoppingCart';
import { faServer } from '@fortawesome/free-solid-svg-icons/faServer';
import { faUser } from '@fortawesome/free-solid-svg-icons/faUser';
import { faUsers } from '@fortawesome/free-solid-svg-icons/faUsers';
import { faRocket } from '@fortawesome/free-solid-svg-icons/faRocket';
import { faBuilding } from '@fortawesome/free-solid-svg-icons/faBuilding';
import { faCube } from '@fortawesome/free-solid-svg-icons/faCube';
import { faGlobe } from '@fortawesome/free-solid-svg-icons/faGlobe';
import { faHandsHelping } from '@fortawesome/free-solid-svg-icons/faHandsHelping';
import { faLock } from '@fortawesome/free-solid-svg-icons/faLock';
import { faShieldAlt } from '@fortawesome/free-solid-svg-icons/faShieldAlt';
import { faChartLine } from '@fortawesome/free-solid-svg-icons/faChartLine';
import { faHistory } from '@fortawesome/free-solid-svg-icons/faHistory';
import { faEye } from '@fortawesome/free-solid-svg-icons/faEye';
import { faTasks } from '@fortawesome/free-solid-svg-icons/faTasks';
import { faExchangeAlt } from '@fortawesome/free-solid-svg-icons/faExchangeAlt';
import { faDesktop } from '@fortawesome/free-solid-svg-icons/faDesktop';
import { faStore } from '@fortawesome/free-solid-svg-icons/faStore';
import { faPalette } from '@fortawesome/free-solid-svg-icons/faPalette';
import { faLink } from '@fortawesome/free-solid-svg-icons/faLink';

import { faFacebookF } from '@fortawesome/free-brands-svg-icons/faFacebookF';
import { faInstagram } from '@fortawesome/free-brands-svg-icons/faInstagram';
import { faTwitter } from '@fortawesome/free-brands-svg-icons/faTwitter';
import { faLinkedin } from '@fortawesome/free-brands-svg-icons/faLinkedin';
import { faSlack } from '@fortawesome/free-brands-svg-icons/faSlack';
import { faWhatsapp } from '@fortawesome/free-brands-svg-icons/faWhatsapp';
import { faTelegram } from '@fortawesome/free-brands-svg-icons/faTelegram';
import { faWordpress } from '@fortawesome/free-brands-svg-icons/faWordpress';
import { faPinterest } from '@fortawesome/free-brands-svg-icons/faPinterest';
import { faYoutube } from '@fortawesome/free-brands-svg-icons/faYoutube';
import { faSoundcloud } from '@fortawesome/free-brands-svg-icons/faSoundcloud';
import { faTumblr } from '@fortawesome/free-brands-svg-icons/faTumblr';
import { faWikipediaW } from '@fortawesome/free-brands-svg-icons/faWikipediaW';

import shareThis from 'share-this';
import * as twitterSharer from 'share-this/dist/sharers/twitter';
import * as facebookSharer from 'share-this/dist/sharers/facebook';
import * as emailSharer from 'share-this/dist/sharers/email';

import Darkmode from 'darkmode-js';


var Masonry = require('masonry-layout');
var WebFont = require('webfontloader');

// Load fonts.
WebFont.load({
    google: {
      families: ['PT Serif:400', 'PT Sans:300,400,500']
    }
});

// Add dark mode widget.
const options = {
  label: '🌓', // default: ''
  autoMatchOsTheme: true // default: true
}

const darkmode = new Darkmode(options);
darkmode.showWidget();

// Add top progress loader
Pace.start();

// Share content.
const selectionShare = shareThis({
    selector: '.site-main.single .entry-content',
    sharers: [twitterSharer, facebookSharer, emailSharer],
});
selectionShare.init();


// Share buttons.
let entryFooter = document.querySelector('#main.single .entry-footer');

if (entryFooter) {
    entryFooter.innerHTML =
        '<div class="entry-share">' +
        '<button class="btn btn-primary" data-sharer="facebook" data-url="' +
        window.location.href +
        '"><i class="fab fa-facebook-f"></i></button>' +
        '<button class="btn btn-primary" data-sharer="twitter" data-url="' +
        window.location.href +
        '"><i class="fab fa-twitter"></i></button>' +
        '<button class="btn btn-primary" data-sharer="linkedin" data-url="' +
        window.location.href +
        '"><i class="fab fa-linkedin"></i></button>' +
        '<button class="btn btn-primary" data-sharer="email" data-title="' +
        document.querySelector('#main.single .entry-title').innerHTML +
        '" data-url="' +
        window.location.href +
        '" data-subject="' +
        document.querySelector('#main.single .entry-title').innerHTML +
        '"><i class="fas fa-envelope"></i></button>' +
        '<button class="btn btn-primary" data-sharer="whatsapp" data-title="' +
        document.querySelector('#main.single .entry-title').innerHTML +
        '" data-url="' +
        window.location.href +
        '"><i class="fab fa-whatsapp"></i></button>' +
        '<button class="btn btn-primary" data-sharer="telegram" data-title="' +
        document.querySelector('#main.single .entry-title').innerHTML +
        '" data-url="' +
        window.location.href +
        '"><i class="fab fa-telegram"></i></button>' +
        '</div>' +
        entryFooter.innerHTML;
}

// Add icons.
library.add(faEnvelope);
library.add(faSearch);
library.add(faBars);
library.add(faShoppingCart);
library.add(faServer);
library.add(faUser);
library.add(faUsers);
library.add(faRocket);
library.add(faBuilding);
library.add(faCube);
library.add(faGlobe);
library.add(faHandsHelping);
library.add(faLock);
library.add(faShieldAlt);
library.add(faChartLine);
library.add(faHistory);
library.add(faEye);
library.add(faTasks);
library.add(faExchangeAlt);
library.add(faDesktop);
library.add(faStore);
library.add(faPalette);
library.add(faLink);

library.add(faFacebookF);
library.add(faInstagram);
library.add(faTwitter);
library.add(faLinkedin);
library.add(faSlack);
library.add(faWhatsapp);
library.add(faTelegram);
library.add(faWordpress);
library.add(faPinterest);
library.add(faYoutube);
library.add(faSoundcloud);
library.add(faTumblr);
library.add(faWikipediaW);
dom.watch();

