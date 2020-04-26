export class Item {
    constructor(
    public id: number,
    public userId: number,
    public creationDatetime: string,
    public orderId: number,
    public category: string,
    public brand: string,
    public size: string,
    public color: string,
    public cond: string,
    public description: string,
    public price: number
    ) {}
}
