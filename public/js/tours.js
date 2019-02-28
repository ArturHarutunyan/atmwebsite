new Vue({
    el: '#main',
    /*data: {

    },*/
    data: function() {
        return {
            allitems:[],
            items:[],
            alltypes:[],
            season:0,
            guaranteed:0,
            period:0,
            group_size:0,
            hotel_category:0,
            hash:window.location.hash.split('#')[1],
            tour_name:''/*
            route: window.location.hash,
            page: 'home'*/
        }
    },
    mounted: function(){
        this.fetchTypeList();
        let self=this;
        $(window).on('hashchange', function (e) {
            if(window.location.hash){
                self.hash=window.location.hash.split('#')[1];
            }
        });
    },
    methods: {
        fetchTypeList:function(){
            axios.get(JSON.parse(tour_api))
            .then((response) => {
                //this.items=response.data;
                this.allitems=response.data;
                this.filterFunction();
            }).catch((error) => {
                console.log(error);
            });
            axios.get(JSON.parse(tourtypes_api))
            .then((response) => {
                let self=this;
                this.alltypes = response.data;
                this.alltypes.forEach(function(obj) {
                    if (self.hash){
                         if(self.hash == obj.id){
                             $('.tours-filter-outer__form__input').removeClass('tours-filter__active');
                             $('[data-value="'+self.hash+'"]').addClass('tours-filter__active');
                             obj.chosen = true;
                         }
                         else{
                             obj.chosen = false;
                         }
                    }
                });
                console.log(this.alltypes);
            }).catch((error) => {
                console.log(error);
            })
        },
        filterFunction:function(){
            let list = [];
            let self = this;
            let not_all_types = false;
            if(self.alltypes.filter(type => type.chosen === true).length > 0 && self.alltypes.filter(type => type.chosen === false).length > 0)
            {
                not_all_types=true;
            }
            this.allitems.filter(function (tour) {
                var current_season = "";
                var current_guaranteed = "";
                var current_period = "";
                var current_group_size = "";
                var current_hotel_category = "";
                if (self.season !== 0) {
                    current_season = self.season;
                }
                else {
                    current_season = tour.season_id;
                }
                if (self.period !== 0) {
                    current_period = self.period;
                }
                else {
                    current_period = tour.period_id;
                }
                if (self.group_size !== 0) {
                    current_group_size = self.group_size;
                }
                else {
                    current_group_size = tour.group_size_id;
                }
                if (self.hotel_category !== 0) {
                    current_hotel_category = self.hotel_category;
                }
                else {
                    current_hotel_category = tour.hotel.category_id;
                }
                if (self.guaranteed !== 0) {
                    current_guaranteed = self.guaranteed;
                }
                else {
                    current_guaranteed = tour.guaranteed;
                }
                if (tour.season_id == current_season && tour.guaranteed == current_guaranteed &&
                    tour.period_id == current_period && tour.group_size_id == current_group_size &&
                    tour.hotel.category_id == current_hotel_category && not_all_types) {
                    self.alltypes.filter(function (type) {
                        if (type.chosen) {
                            tour.tour_types.filter(function (chosen_tour_type) {
                                if (chosen_tour_type.id == type.id) {
                                    if (!list.includes(tour)) {
                                        list.push(tour);
                                    }
                                }
                            })
                        }
                    });
                }
                else{
                    if (tour.season_id == current_season && tour.guaranteed == current_guaranteed &&
                        tour.period_id == current_period && tour.group_size_id == current_group_size &&
                        tour.hotel.category_id == current_hotel_category) {
                        if (!list.includes(tour)) {
                            list.push(tour);
                        }
                        self.alltypes.filter(function( obj ){
                            obj.chosen=false;
                        });
                    }
                }
            });
            this.items = list;
            console.log(this.items);
        },
        set_season:function(a){
            if(this.season!=a){
                this.season = a;
            }
            else{
                this.season = 0;
            }
        },
        set_period:function(a){
            if(this.period!=a){
                this.period = a;
            }
            else{
                this.period = 0;
            }
        },
        set_group_size:function(a){
            if(this.group_size!=a){
                this.group_size = a;
            }
            else{
                this.group_size = 0;
            }
        },
        set_guaranteed:function(a){
            this.guaranteed = a;
        },
        set_types:function(a){
            let k=0;
            this.alltypes.filter(function( obj ){
                if(!obj.chosen){
                    ++k;
                }
            });
            this.alltypes.filter(function (obj) {
                if (!k) {
                    obj.chosen = false;
                }
                else {
                    if (obj.id == a) {
                        if (!obj.chosen) {
                            obj.chosen = true;
                        }
                        else {
                            obj.chosen = false;
                        }
                    }
                }
                console.log(obj);
            });
            this.filterFunction();
        },
        set_all_types:function(){
            this.alltypes.filter(function( obj ){
                obj.chosen=false;
            });
            this.filterFunction();
        },
        set_hotel_category:function (a) {
            if(this.hotel_category!=a){
                this.hotel_category = a;
            }
            else{
                this.hotel_category = 0;
            }
        }
    },
    watch: {
        hash: function(newHash){
            //this.hash = window.location.hash.split("#")[1];
            this.fetchTypeList();
        }
    }
});