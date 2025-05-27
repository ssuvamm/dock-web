package com.example.dockerdemo;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class HelloController {

    @GetMapping("/")
    public String hello() {
        return "<h1>Hello from Spring Boot!</h1><p>This app is running inside a Docker container.</p>";
    }
}
