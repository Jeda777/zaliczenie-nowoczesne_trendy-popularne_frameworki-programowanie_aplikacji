import { NgModule, provideZonelessChangeDetection } from '@angular/core';
import { AppComponent } from './app.component';
import { ReactiveFormsModule } from '@angular/forms';
import { provideHttpClient } from '@angular/common/http';
import { CommonModule } from '@angular/common';
import { BrowserModule } from '@angular/platform-browser';
import { provideRouter } from '@angular/router';
import { AppRoutingModule } from './app.routing.module';
import { Login } from './login/login';
import { Home } from './home/home';

@NgModule({
  declarations: [AppComponent, Login, Home],
  imports: [ReactiveFormsModule, CommonModule, BrowserModule, AppRoutingModule],
  providers: [provideHttpClient(), provideZonelessChangeDetection()],
  bootstrap: [AppComponent],
})
export class AppModule {}
