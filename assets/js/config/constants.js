/*
 * Constantes para toda la aplicación.
 *
 * Copyright 2021 Editorial Santillana
 *
 * @autor @dgalicia
 */
var constants = (function(window) {
	'use strict';

    // URL base para todas las solicitudes tipo RESTful API
    var URL_BASE = 'http://localhost/examen_tecnico_perti/'
    var API_URL_BASE = URL_BASE + '/api/';

        return {
            'API_URL_BASE': API_URL_BASE,
            'URL_BASE' : URL_BASE,
        };

}(window));
