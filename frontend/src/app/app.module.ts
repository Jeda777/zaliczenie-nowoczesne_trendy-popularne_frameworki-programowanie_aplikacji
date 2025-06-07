import { NgModule, provideZonelessChangeDetection } from '@angular/core';
import { AppComponent } from './app.component';
import { ReactiveFormsModule } from '@angular/forms';
import { provideHttpClient } from '@angular/common/http';
import { CommonModule } from '@angular/common';
import { BrowserModule } from '@angular/platform-browser';

@NgModule({
  declarations: [AppComponent],
  imports: [ReactiveFormsModule, CommonModule, BrowserModule],
  providers: [provideHttpClient(), provideZonelessChangeDetection()],
  bootstrap: [AppComponent],
})
export class AppModule {}
