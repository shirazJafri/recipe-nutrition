##############################################################################
# Some cURL examples to test the CRUD operations (uncomment as necessary)
##############################################################################


# To create a new recipe (based on existing ingredients).

# curl -X POST http://localhost:8000/api/recipes \
#   -H "Content-Type: application/json" \
#   -d '{
#     "name": "Hearty Protein Bowl",
#     "description": "A balanced meal with grains, veggies, and protein.",
#     "ingredients": [
#       {
#         "name": "Brown Rice (cooked)",
#         "carbs": 23.0,
#         "fat": 1.0,
#         "protein": 2.6
#       },
#       {
#         "name": "Chicken Breast (cooked)",
#         "carbs": 0.0,
#         "fat": 3.6,
#         "protein": 31.0
#       },
#       {
#         "name": "Broccoli",
#         "carbs": 6.6,
#         "fat": 0.4,
#         "protein": 2.8
#       },
#       {
#         "name": "Carrot",
#         "carbs": 9.6,
#         "fat": 0.2,
#         "protein": 0.9
#       },
#       {
#         "name": "Almonds",
#         "carbs": 21.6,
#         "fat": 49.9,
#         "protein": 21.2
#       }
#     ],
#     "steps": [
#       {
#         "step_number": 1,
#         "description": "Cook the brown rice according to package instructions."
#       },
#       {
#         "step_number": 2,
#         "description": "Grill the chicken breast until fully cooked and lightly browned."
#       },
#       {
#         "step_number": 3,
#         "description": "Steam broccoli and carrots until tender-crisp."
#       },
#       {
#         "step_number": 4,
#         "description": "Plate the rice, chicken, and vegetables. Top with chopped almonds."
#       }
#     ]
#   }'

# To create a new recipe (based on non-existing ingredients).

curl -X POST http://localhost:8000/api/recipes \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Fresh Quinoa Salad",
    "description": "A light and nutritious quinoa salad with zucchini.",
    "ingredients": [
      {
        "name": "Quinoa",
        "carbs": 21.3,
        "fat": 1.9,
        "protein": 4.4
      },
      {
        "name": "Zucchini",
        "carbs": 3.1,
        "fat": 0.3,
        "protein": 1.2
      }
    ],
    "steps": [
      {
        "step_number": 1,
        "description": "Cook the quinoa until soft and fluffy."
      },
      {
        "step_number": 2,
        "description": "Chop and sauté the zucchini until tender."
      },
      {
        "step_number": 3,
        "description": "Combine quinoa and zucchini, season as desired, and serve chilled."
      }
    ]
  }'

# To get all the recipes.
# curl -X GET http://localhost:8000/api/recipes

# To get a single recipe.
# curl -X GET http://localhost:8000/api/recipes/{id}

# To delete a single recipe.
# curl -X DELETE http://localhost:8000/api/recipes/{id}
