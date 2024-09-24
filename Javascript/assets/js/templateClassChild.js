class ClassChild extends ClassParent{
    constructor(attr1, attr2, attr3, attr4, attr5, attr6, attr7, attr8){
        super(attr1, attr2, attr3, attr4);
        this._attr5 = attr5;
        this._attr6 = attr6;
        this._attr7 = attr7;
        this._attr8 = attr8;
    }

    get attr5(){
        return this._attr5;
    }

    set attr5(attr5){
        this._attr5 = attr5;
    }

    get attr6(){
        return this._attr6;
    }

    set attr6(attr6){
        this._attr6 = attr6;
    }

    get attr7(){
        return this._attr7;
    }

    set attr7(attr7){
        this._attr7 = attr7;
    }

    get attr8(){
        return this._attr8;
    }

    set attr8(attr8){
        this._attr8 = attr8;
    }
}