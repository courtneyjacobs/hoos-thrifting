import { Component, OnInit } from '@angular/core';

@Component({
    selector: 'app-pnf',
    templateUrl: './pnf.component.html',
    styleUrls: ['./pnf.component.css']
})
export class PnfComponent implements OnInit {
    title = 'Page Not Found';
    url = 'pnf';
    constructor() { }

    ngOnInit(): void {
    }

}
