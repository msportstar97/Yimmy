import sys
import matplotlib.pyplot as plt


def nutrition_breakdown(food_name, cal, f, c, p):
    f_perc = 9*f/cal
    c_perc = 4*c/cal
    p_perc = 4*p/cal
    other = 1 - f_perc - c_perc - p_perc

    nutrition = [f, c, p, other]
    breakdown = ['Fat', 'Carbohydrate', 'Protein', 'Other']
    colors = ['#B1277B', '#27A6B6', '#EEAA28', '#E8E8E8']
    explode = (0.05, 0.05, 0.05, 0.05)
    plt.pie(nutrition, explode = explode, labels=breakdown, colors=colors, startangle=90, autopct='%1.1f%%', shadow=True)
    plt.title(food_name)
    plt.axis('equal')
    plt.show()

# nutrition_breakdown(cal, f, c, p)

