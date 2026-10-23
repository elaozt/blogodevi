package com.ornek.blog;

import org.springframework.data.domain.Sort;
import org.springframework.security.core.Authentication;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;

@Controller
public class BlogController {
    private final ArticleRepository articles;
    private final BlogUserRepository users;
    private final PasswordEncoder passwordEncoder;

    public BlogController(ArticleRepository articles, BlogUserRepository users, PasswordEncoder passwordEncoder) {
        this.articles = articles;
        this.users = users;
        this.passwordEncoder = passwordEncoder;
    }

    @GetMapping("/")
    public String home(Model model, Authentication authentication) {
        model.addAttribute("articles", articles.findAll(Sort.by(Sort.Direction.DESC, "createdAt")));
        model.addAttribute("blogName", System.getenv().getOrDefault("BLOG_NAME", "Benim Blogum"));
        boolean loggedIn = authentication != null && authentication.isAuthenticated()
                && !"anonymousUser".equals(authentication.getPrincipal());
        boolean isOwner = loggedIn && authentication.getAuthorities().stream()
                .anyMatch(authority -> authority.getAuthority().equals("ROLE_OWNER"));
        model.addAttribute("loggedIn", loggedIn);
        model.addAttribute("isOwner", isOwner);
        return "index";
    }

    @GetMapping("/register")
    public String registerPage() {
        return "register";
    }

    @PostMapping("/register")
    public String register(@RequestParam String username,
                           @RequestParam String password,
                           RedirectAttributes redirect) {
        String cleanUsername = username.trim();
        if (!cleanUsername.matches("[A-Za-z0-9_]{3,60}")) {
            redirect.addFlashAttribute("error", "Kullanıcı adı 3-60 karakter olmalı; harf, sayı ve _ kullanabilirsin.");
            return "redirect:/register";
        }
        if (password.length() < 8) {
            redirect.addFlashAttribute("error", "Şifre en az 8 karakter olmalı.");
            return "redirect:/register";
        }
        if (users.existsByUsername(cleanUsername)) {
            redirect.addFlashAttribute("error", "Bu kullanıcı adı zaten alınmış.");
            return "redirect:/register";
        }
        users.save(new BlogUser(cleanUsername, passwordEncoder.encode(password), "READER"));
        redirect.addFlashAttribute("message", "Hesap oluşturuldu. Giriş yapabilirsin; makale ekleme yalnızca blog sahibine açıktır.");
        return "redirect:/";
    }

    @GetMapping("/makale/yeni")
    public String newArticle() {
        return "new-article";
    }

    @PostMapping("/makale/yeni")
    public String saveArticle(@RequestParam String title,
                              @RequestParam String content,
                              RedirectAttributes redirect) {
        if (title.isBlank() || content.isBlank()) {
            redirect.addFlashAttribute("error", "Başlık ve makale boş bırakılamaz.");
            return "redirect:/makale/yeni";
        }
        articles.save(new Article(title.trim(), content.trim()));
        redirect.addFlashAttribute("message", "Makale eklendi.");
        return "redirect:/";
    }
}
