<template>
    <div>
        <div class="form-group">
            <label for="abbr">Department</label>
            <select class="form-control" id="department_id" name="department_id" v-model="department">
                  <option v-for="department in departments" :value="department.id">{{ department.name }}</option>
            </select>
        </div>

        <hr />
        <h4>Available Apparatus</h4>

        <div v-for="unit in availableUnits">
          <div class="display-block">
            <label for="units[]"><input type="checkbox" name="units[]" :value="unit.id" :checked="isSelected(unit.id)" /> {{ unit.name }}</label>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
    export default {
        props: ['dataUnits', 'dataDepartments','dataCurrentUnits'],

        data() {
            return {
                units: JSON.parse(this.dataUnits),
                departments: JSON.parse(this.dataDepartments),
                currentUnits: (this.dataCurrentUnits === undefined) ? [] : JSON.parse(this.dataCurrentUnits),

                department: "1"
            }
        },

        computed: {
            availableUnits: function() {
                return _.filter(this.units, (unit) => {
                    return unit.department_id == this.department;
                });
            }
        },

        methods: {
            isSelected: function(id) {
                return this.currentUnits.includes(id);
            }
        }
    }
</script>
