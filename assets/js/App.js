/*!
 * Ext JS Library 3.3.1
 * Copyright(c) 2006-2010 Sencha Inc.
 * licensing@sencha.com
 * http://www.sencha.com/license
 */
Ext.app.App = function(cfg){
    Ext.apply(this, cfg);
    this.addEvents({
        'ready' : true,
        'beforeunload' : true
    });

    Ext.onReady(this.initApp, this);
};

Ext.extend(Ext.app.App, Ext.util.Observable, {
    isReady: false,
    startMenu: null,
    modules: null,

    getStartConfig : function(){

    },

    initApp : function(){
    	this.startConfig = this.startConfig || this.getStartConfig();

        this.desktop = new Ext.Desktop(this);

		this.launcher = this.desktop.taskbar.startMenu;

		this.modules = this.getModules();
        if(this.modules){
            this.initModules(this.modules);
        }

        this.init();

        Ext.EventManager.on(window, 'beforeunload', this.onUnload, this);
		this.fireEvent('ready', this);
        this.isReady = true;
    },

    getModules : Ext.emptyFn,
    init : Ext.emptyFn,

    initModules : function(ms){
		for(var i = 0, len = ms.length; i < len; i++){
            var m = ms[i];
            this.launcher.add(m.launcher);
            m.app = this;
        }
    },

    getModule : function(name){
    	var ms = this.modules;
    	for(var i = 0, len = ms.length; i < len; i++){
    		if(ms[i].id == name || ms[i].appType == name){
    			return ms[i];
			}
        }
        return '';
    },

    onReady : function(fn, scope){
        if(!this.isReady){
            this.on('ready', fn, scope);
        }else{
            fn.call(scope, this);
        }
    },

    getDesktop : function(){
        return this.desktop;
    },

    onUnload : function(e){
        if(this.fireEvent('beforeunload', this) === false){
            e.stopEvent();
        }
    }
});



class Converter {
  static bn = ['১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০'];
  static en = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];

  static enMonths = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December',
  ];

  static enShortMonths = [
    'Jan',
    'Feb',
    'Mar',
    'Apr',
    'May',
    'June',
    'July',
    'Aug',
    'Sep',
    'Oct',
    'Nov',
    'Dec',
  ];

  static bnMonths = [
    'জানুয়ারি',
    'ফেব্রুয়ারি',
    'মার্চ',
    'এপ্রিল',
    'মে',
    'জুন',
    'জুলাই',
    'অগাস্ট',
    'সেপ্টেম্বর',
    'অক্টোবর',
    'নভেম্বর',
    'ডিসেম্বর',
  ];

  // ... (other arrays for days and times)
  static bn2en(number) {
    return number.replace(new RegExp(`[${Converter.bn.join('')}]`, 'g'), (match) =>
      Converter.en[Converter.bn.indexOf(match)]
    );
  }

  static en2bn(number) {
    return number.replace(new RegExp(`[${Converter.en.join('')}]`, 'g'), (match) =>
      Converter.bn[Converter.en.indexOf(match)]
    );
  }

  static bnDate(date) {
    // Convert Numbers
    date = Converter.bn2en(date);

    // Convert Months
    for (let i = 0; i < Converter.enMonths.length; i++) {
      date = date.replace(new RegExp(Converter.enMonths[i], 'g'), Converter.bnMonths[i]);
      date = date.replace(new RegExp(Converter.enShortMonths[i], 'g'), Converter.bnMonths[i]);
    }

    // Convert Days (You can add similar logic for days)

    return date;
  }

  static bnTime(time) {
    // Convert Numbers
    time = Converter.bn2en(time);

    // Convert Time (You can add similar logic for times)

    return time;
  }
}

/*// Example usage:
const bnNumber = '১২৩৪৫';
const enNumber = '12345';

console.log(Converter.bn2en(bnNumber)); // Outputs: '12345'
console.log(Converter.en2bn(enNumber)); // Outputs: '১২৩৪৫'

const bnDate = '১২ মার্চ ২০২৩';
const enDate = 'March 12, 2023';

console.log(Converter.bnDate(bnDate)); // Outputs: '12 মার্চ 2023'

const bnTime = '৫:৩০ PM';
const enTime = '5:30 PM';

console.log(Converter.bnTime(bnTime)); // Outputs: '5:30 PM'*/