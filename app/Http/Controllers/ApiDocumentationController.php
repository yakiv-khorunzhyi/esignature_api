<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *      version="0.0.1",
 *      title="E-Signature API",
 *      description="Basic E-Signature API using Laravel that allows users to e-sign documents.",
 *      @OA\Contact(
 *          email="yakiv.khorunzhyi@gmail.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 *      description="Enter your Bearer token in the format: `Bearer {token}`"
 *  )
 */
class ApiDocumentationController extends Controller
{
}
