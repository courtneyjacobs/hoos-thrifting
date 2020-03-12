import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-sell',
  templateUrl: './sell.component.html',
  styleUrls: ['./sell.component.css']
})
export class SellComponent implements OnInit {
    title='Sell';
    url='sell';
    constructor() { }

    ngOnInit(): void {
    }

}
