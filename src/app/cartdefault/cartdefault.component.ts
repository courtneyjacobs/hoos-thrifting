import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-cartdefault',
  templateUrl: './cartdefault.component.html',
  styleUrls: ['./cartdefault.component.css']
})
export class CartdefaultComponent implements OnInit {
  title = 'Cart';
  url = 'cart';

  constructor() { }

  ngOnInit(): void {
  }

}
