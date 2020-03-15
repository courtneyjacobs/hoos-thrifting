import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CartdefaultComponent } from './cartdefault.component';

describe('CartdefaultComponent', () => {
  let component: CartdefaultComponent;
  let fixture: ComponentFixture<CartdefaultComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CartdefaultComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CartdefaultComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
