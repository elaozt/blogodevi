package com.ornek.blog;

import org.springframework.boot.CommandLineRunner;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Component;

@Component
public class OwnerAccountInitializer implements CommandLineRunner {
    private final BlogUserRepository users;
    private final PasswordEncoder passwordEncoder;

    public OwnerAccountInitializer(BlogUserRepository users, PasswordEncoder passwordEncoder) {
        this.users = users;
        this.passwordEncoder = passwordEncoder;
    }

    @Override
    public void run(String... args) {
        String username = System.getenv().getOrDefault("BLOG_USER", "sahibi");
        String password = System.getenv().getOrDefault("BLOG_PASSWORD", "blog1234");
        if (!users.existsByUsername(username)) {
            users.save(new BlogUser(username, passwordEncoder.encode(password), "OWNER"));
        }
    }
}
