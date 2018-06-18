.model small
.stack 100
.data      
    s1 db 13, 10, 'Nhap n: ','$'     
    s2 db 13, 10, 'n!: ','$'   
.code
    main proc      
        mov ax, @data
        mov ds, ax                          
    ;Nhap   max 8!
        mov ah, 9    
        lea dx, s1
        int 21h
    
        xor bx, bx              ;reset bx thanh 0
        xor cx, cx              ;reset cx thanh 0
        mov ah, 1
        int 21h
        tiepTuc:  
            mov ah, 00h         ; reset ah thanh 0
            sub al, 30h         ; ky tu thanh so
            push ax             ; cat vao ngan xep // backup
            mov ax, 10          ; ax = 10      
            mul bx              ; ax = 10.bx
            mov bx, ax          ; bx = ax
            pop ax              ; lay lai ax tu ngan xep
            add bx, ax          ; 10 = 1*10+0 
            mov ah, 1
            int 21h
            cmp al, 13          ; da enter chua?
            jne tiepTuc         ; nhap tiep
        
        ;Tinh toan    
            mov cx, bx          ; so lan lap
            mov ax, 1   
            cmp bx, 0
            je  break         
            lap1:   
                mul cx 
                cmp cx, 1
                je break
            loop lap1   
            break:       
            mov bx,ax
             
        ;HienThi   %10 de lay tung chu so
            ;Chan
            mov ah, 9       ; xuong dong
            lea dx, s2
            int 21h
 
            mov ax, bx  ; ax = bx
            xor cx, cx  ; gan cx = 0
            mov bx, 10  ; so chia la 10
            chia1:
                xor dx, dx  ; gan dx = 0
                div bx      ; ax = ax / bx; dx = ax % bx
                push dx
                inc cx
                cmp ax, 0   ; kiem tra xem thuong bang khong chua?
                jne chia1    ; neu khong bang thi lai chia
                mov ah, 2
            hien1:
                pop dx
                add dl, 30h
                int 21h
                loop hien1

        mov ah, 4ch
        int 21h
         
    main endp

     
end main