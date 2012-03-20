var JS_Slider = new Class({
    
    initialize: function(options)
    {
		this.element = this.element || null;    	
        this.options = Object.extend({
	        w: 100,
	        h: 200,
	        num_elem: 4,
			total: 0,
			url: '',
	        mode: 'horizontal',
	        direction: 'right',
	        wrapper: 'ja-slide-wrapper',
	        duration: 1000,
	        interval: 3000,
	        auto: 1
	    },options||{});
	    
		if (this.options.total){
            if (this.options.total < this.options.num_elem) this.options.num_elem = this.options.total;
			this.elements = new Array(this.options.total);
        }else
			this.elements = new Array();
			
        this.current = 0;
        $(this.options.wrapper).setStyle('position', 'relative');
        $(this.options.wrapper).setStyle('overflow', 'hidden');
		if(this.options.mode=='virtical'){
			$(this.options.wrapper).setStyle('width', this.options.w);
			$(this.options.wrapper).setStyle('height', this.options.h*this.options.num_elem);
		}else{
			$(this.options.wrapper).setStyle('width', this.options.w*this.options.num_elem);
			$(this.options.wrapper).setStyle('height', this.options.h);
		}

		this.ef_u = {};
		this.ef_d = {};
		this.ef_l = {};
		this.ef_r = {};
        for(i=0;i<=this.options.num_elem;i++) {
    		this.ef_u[i] = { 'top': [ i*this.options.h, (i-1)*this.options.h] };
    		this.ef_d[i] = { 'top': [ (i-1)*this.options.h, i*this.options.h] };
    		this.ef_l[i] = { 'left': [ i*this.options.w, (i-1)*this.options.w] };
    		this.ef_r[i] = { 'left': [ (i-1)*this.options.w, i*this.options.w] };
        }
    },
    
    getFx: function(){
        if (this.options.mode == 'virtical') {
            if (this.options.direction == 'up') {
                return this.ef_u;
            }else{
                return this.ef_d;
            }
        }else{
            if (this.options.direction == 'left') {
                return this.ef_l;
            }else{
                return this.ef_r;
            }
        }
    },
    
    add: function(text){
        divobj = new Element('DIV', {'id':'jsslide_' + this.elements.length, 'class':'jsslide'});
        divobj.innerHTML = text;
        divobj.setStyle ('position','absolute');
        divobj.setStyle('width', this.options.w);
        divobj.setStyle('height', this.options.h);
        if(this.elements.length > 1) {
            divobj.injectAfter (this.elements[this.elements.length-2]);
        }else{
            divobj.inject ($(this.options.wrapper))
        }
		this.hide(divobj);
        this.elements.push(divobj);
    },
    
	//Update element i
	update: function (text, i){
        divobj = new Element('DIV', {'id':'jsslide_' + i, 'class':'jsslide'});
        divobj.innerHTML = text;
        divobj.setStyle ('position','absolute');
        divobj.setStyle('width', this.options.w);
        divobj.setStyle('height', this.options.h);
		divobj.inject ($(this.options.wrapper))
		this.hide(divobj);
		this.elements[i] = divobj;
	},
	
    hide: function (el) {
        if (this.options.mode == 'virtical') {
            el.setStyle('top', '-999em');
            el.setStyle('left', '0');            
        }else{
            el.setStyle('top', '0');
            el.setStyle('left', '-999em');            
        }
    },
    setPos: function (elems) {
		if (!elems) elems = this.getRunElems();
        for(i=0;i<elems.length;i++) {
			el = elems[i];
			if (el){
				if (this.options.mode == 'virtical') {
					if (this.options.direction == 'up') {
						el.setStyle('top', this.options.h*i);
					}else{
						el.setStyle('top', this.options.h*(i-1));                
					}
				}else{
					if (this.options.direction == 'left') {
						el.setStyle('left', this.options.w*i);
					}else{
						el.setStyle('left', this.options.w*(i-1));                
					}
				}
			}
		}
    },

	getRunElems: function(){
        var objs = new Array();
		if(this.options.direction=='left' || this.options.direction=='up'){
			adj = 0;
		}else{
			adj = this.elements.length-1;
		}
      	for(i=0;i<=this.options.num_elem;i++) {
            objs[i] = this.elements[(this.current+i+adj) % this.elements.length];
        }
        if (this.options.total <= this.options.num_elem) {
            if(this.options.direction=='left' || this.options.direction=='up'){
                objs[this.options.num_elem] = null;
            }else{
                objs[0] = null;
            }
        }
		return objs;		
	},
	
    start: function () {
		//clearTimeout(this.timeOut);
		if (!this.elements[this.next()]) {
			this.nextRun();
			return;
		}
        var objs = this.getRunElems();
		this.setPos(objs);
		if (this.x) this.x.stop();
		this.running = 1;
        this.x = new Fx.Elements(objs, {duration: this.options.duration, onComplete:this.runcomplete.bind(this)})
		this.x.start(this.getFx());
		this.current = this.nextCurr();
    },
    runcomplete: function() {
    	this.running = 0;
    	this.nextRun();
    },    
    nextRun: function () {
    	if (this.running) return;
		clearTimeout(this.timeOut);
		if (this.options.total <= this.options.num_elem) return;
		if (this.options.auto){
			this.timeOut = setTimeout(this.start.bind(this),this.options.interval);
			this.fetchNext();
		}		
    },
	
	nextCurr: function () {
		if(this.options.direction=='left' || this.options.direction=='up'){
	        next = (this.current+1) % this.elements.length;
		}else{
	        next = (this.current+this.elements.length-1) % this.elements.length;			
		}
		return next;
	},

	next: function () {
		if(this.options.direction=='left' || this.options.direction=='up'){
	        next = (this.current+this.options.num_elem) % this.elements.length;
		}else{
	        next = (this.current+this.elements.length-1) % this.elements.length;			
		}
		return next;
	},
	
	fetchNext: function(){
		next = this.next();
		if (!this.elements[next]){
			//url = this.options.url + '?total='+this.options.total+'&news='+next;
			//new Ajax(url,{method:'get',onComplete:this.fetchUpdate.bind(this)}).request(); 
			return false;
		}
	},
	
	fetchUpdate: function(text){
		next = this.next();
		this.update(text, next);
	}	
	
});
