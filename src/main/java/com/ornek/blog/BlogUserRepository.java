package com.ornek.blog;

import java.util.Optional;
import org.springframework.data.jpa.repository.JpaRepository;

public interface BlogUserRepository extends JpaRepository<BlogUser, Long> {
    Optional<BlogUser> findByUsername(String username);
    boolean existsByUsername(String username);
}
