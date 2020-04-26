import { Component, OnInit } from '@angular/core';
import { Item } from '../item';
import { ItemService } from '../item.service';


@Component({
  selector: 'app-sell',
  templateUrl: './sell.component.html',
  styleUrls: ['./sell.component.css']
})
export class SellComponent implements OnInit {
    title='Sell';
    url='sell';

    constructor(public itemService: ItemService) {}

    confirm_msg = '';

    data_submitted = new Item(0, 0, '', 0, '', '', '', '','','', 0);
    
    categories = ['Tops', 'Bottoms', 'Shoes', 'Accessories', 'Other'];
  
    // get confirmation or rejection
    addItem(): void {
        console.log('You submitted value: ', this.data_submitted);

        this.itemService.addItem(this.data_submitted)
           .subscribe((res) => {
               this.confirm_msg = res}); 
     } 

    ngOnInit(): void { }

}