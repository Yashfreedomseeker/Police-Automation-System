;; Atomic operations

;;;; Copyright (C) 2016 Free Software Foundation, Inc.
;;;;
;;;; This library is free software; you can redistribute it and/or
;;;; modify it under the terms of the GNU Lesser General Public
;;;; License as published by the Free Software Foundation; either
;;;; version 3 of the License, or (at your option) any later version.
;;;;
;;;; This library is distributed in the hope that it will be useful,
;;;; but WITHOUT ANY WARRANTY; without even the implied warranty of
;;;; MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
;;;; Lesser General Public License for more details.
;;;;
;;;; You should have received a copy of the GNU Lesser General Public
;;;; License along with this library; if not, write to the Free Software
;;;; Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA
;;;;

(define-module (ice-9 atomic)
  #:use-module ((language tree-il primitives)
                :select (add-interesting-primitive!))
  #:export (make-atomic-box
            atomic-box?
            atomic-box-ref
            atomic-box-set!
            atomic-box-swap!
            atomic-box-compare-and-swap!))

(eval-when (expand load eval)
  (load-extension (string-append "libguile-" (effective-version))
                  "scm_init_atomic")
  (add-interesting-primitive! 'make-atomic-box)
  (add-interesting-primitive! 'atomic-box?)
  (add-interesting-primitive! 'atomic-box-ref)
  (add-interesting-primitive! 'atomic-box-set!)
  (add-interesting-primitive! 'atomic-box-swap!)
  (add-interesting-primitive! 'atomic-box-compare-and-swap!))