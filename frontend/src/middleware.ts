import { NextRequest, NextResponse } from "next/server";

const middleware = (request: NextRequest) => {
    const url = request.nextUrl.clone();
    
    if (url.pathname === '/') {
        url.pathname = '/gerenciar/funcionarios';
        return NextResponse.redirect(url);
    }
};

export default middleware;