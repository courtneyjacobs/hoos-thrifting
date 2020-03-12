import { Component, OnInit } from '@angular/core';
import { Item } from '../item';

@Component({
  selector: 'app-shop',
  templateUrl: './shop.component.html',
  styleUrls: ['./shop.component.css']
})
export class ShopComponent implements OnInit {
    title = 'Shop';
    url = 'shop';
    items: Item[] = [
        {
            id: 1,
            listingDatetime: '20200312T12:00:00',
            status: 'active',
            category: '1',
            brand: '2',
            size: '3',
            color: 'blue',
            condition: 'new',
            description: 'A blue shirt.',
            price: 5,
            image: '../../assets/testimage.png'
        },
        {
            id: 2,
            listingDatetime: '20200311T12:00:00',
            status: 'sold',
            category: '2',
            brand: '3',
            size: '4',
            color: 'green',
            condition: 'like new',
            description: 'A green shirt.',
            price: 13,
            image: '../../assets/testimagey.png'
        },
        {
            id: 3,
            listingDatetime: '20200311T12:00:00',
            status: 'sold',
            category: '2',
            brand: '3',
            size: '4',
            color: 'green',
            condition: 'like new',
            description: 'A green shirt.',
            price: 30,
            image: '../../assets/testimagex.png'
        },
        {
            id: 4,
            listingDatetime: '20200311T12:00:00',
            status: 'sold',
            category: '2',
            brand: '3',
            size: '4',
            color: 'green',
            condition: 'like new',
            description: 'A green shirt.',
            price: 14,
            image: '../../assets/testimage.png'
        },
        {
            id: 5,
            listingDatetime: '20200311T12:00:00',
            status: 'sold',
            category: '2',
            brand: '3',
            size: '4',
            color: 'green',
            condition: 'like new',
            description: 'A green shirt.',
            price: 2,
            image: '../../assets/testimagex.png'
        },
    ];

    constructor() { }

    ngOnInit(): void {
    }

}
