import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-fundraise',
  templateUrl: './fundraise.component.html',
  styleUrls: ['./fundraise.component.css']
})
export class FundraiseComponent implements OnInit {
    title = 'Fundraise';
    url = 'fundraise';
    constructor() { }

    ngOnInit(): void {
    }

}
