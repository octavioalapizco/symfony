/*
 * File: stoHorarios.js
 * Date: Sat May 12 2012 17:36:29 GMT-0600 (Hora verano, Montañas (México))
 * 
 * This file was generated by Ext Designer version 1.1.2.
 * http://www.sencha.com/products/designer/
 *
 * This file will be auto-generated each and everytime you export.
 *
 * Do NOT hand edit this file.
 */

stoHorarios = Ext.extend(Ext.data.JsonStore, {
    constructor: function(cfg) {
        cfg = cfg || {};
        stoHorarios.superclass.constructor.call(this, Ext.apply({
            idProperty: 'idHora',
            root: 'horario',
            fields: [
                {
                    name: 'idHora'
                },
                {
                    name: 'horaInicio'
                },
                {
                    name: 'horaFin'
                }
            ]
        }, cfg));
    }
});
