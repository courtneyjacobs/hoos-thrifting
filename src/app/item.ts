export class Item {
    constructor(
    public id: number,
    public listingDatetime: string,
    public status: string,
    public category: string,
    public brand: string,
    public size: string,
    public color: string,
    public condition: string,
    public description: string,
    public price: number
    ) {}
}
