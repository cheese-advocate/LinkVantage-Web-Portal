/**
 * This method will be written to have a return type of boolean.
 * This will be used in other methods to prevent page transitions to take place
 * if the user chooses cancel.
 * @return {undefined}
 */
function warningDataLoss()
{
    confirm("WARNING!\nAll entered data will be lost when leaving this page!\nAre you sure you want to leave this page?");
}